<?php
namespace WorldlangDict;

define('TRANS_SEPERATORS', ",;:");

// Exceptions to the stress rules: one syllable words that have no stresses
define('WORDS_TO_SKIP', ["am", "bax", "cel", "ci", "cis", "de", "di",
    "dur", "e", "el", "em", "ex", "fal", "fe", "fol", "ger", "har", "hoy",
    "hu", "in", "ji", "kam", "ki", "kom", "ku", "kwas", "le", "mas", "na",
    "nor", "of", "or", "pas", "per", "por", "pro", "su", "tas", "tem", "ton",
    "tras", "wey", "xa", "yon"]);

define('REPLACE_GLB_REGEX', [ '/c/', '/j/', '/r/', '/x/', '/y/', '/h/' ]);
define('REPLACE_IPA',      [ 't͡ʃ',  'd͡ʒ',   'ɾ',   'ʃ',   'j',   'x'  ]);

define('STRESS_MARKER', "\u{02C8}");
define('DEMARC', "\u{001F}"); // Unicode/ASCII seperator character
define('NO_SHIFT_CHARS', ['a', 'e', 'i', 'o', 'u', '-']); // Don't shift past vowels or hyphens
define('ONSET_CONSONANTS', ['b', 'd', 'f', 'g', 'k', 'p', 't', 'v']);
define('CODA_CONSONANTS', ['c', 'x', 'j', 'l', 'm', 'n', 'r', 's', 'w', 'x', 'y', 'z']);
define('FINAL_VOWEL_REGEX', "/[aeiou](?!.*[aeiou])/i");
define('GLOBAL_VOWEL_REGEX', "/[aeiou]/i");


// Added at home in remote. Add in project. Added offline.
class Word
{
    public $term;
    public $category;
    public $part;
    public $etymology;
    public $relatedWords;
    public $ipaLink;
    public $example;
    public $tags;
    public $synonyms;
    public $antonyms;
    public $status;


    // added before online.
    // Create object from CSV dictionary array
    public function __construct($config, $rawWords, $wordKey, $d)
    {
        $this->term       = $rawWords[$wordKey]['Word'];
        $this->termIndex  = strtolower(trim($wordKey));
        $this->category   = $rawWords[$wordKey]['Category'];
        $this->wordClass  = $rawWords[$wordKey]['WordClass'];
        $this->etymology  = $rawWords[$wordKey]['LexiliAsel'];
        $this->tags       = $rawWords[$wordKey]['Tags'];
        $this->example    = $rawWords[$wordKey]['Example'];
        $this->status     = $rawWords[$wordKey]['LexiliEstatus'];

        $this->translation['eng'] = $rawWords[$wordKey]['TranslationEng'];
        $this->translation['epo'] = $rawWords[$wordKey]['TranslationEpo'];
        $this->translation['deu'] = $rawWords[$wordKey]['TranslationDeu'];
        $this->translation['fra'] = $rawWords[$wordKey]['TranslationFra'];
        $this->translation['rus'] = $rawWords[$wordKey]['TranslationRus'];
        $this->translation['spa'] = $rawWords[$wordKey]['TranslationSpa'];
        $this->translation['zho'] = $rawWords[$wordKey]['TranslationZho'];

        $this->parseEtymology($config, $d);
        $this->parseTags($config, $d);
        $this->parseSynAnt($rawWords[$wordKey]);
        $this->generateSearchTerms($config->worldlang, $d, $rawWords[$wordKey]['SearchTermsEng']);
        $this->generateIpa($config);
        // if($this->term == 'tas') {

        //     var_dump($rawWords[$wordKey]);
        //     var_dump($this);
        // }
    }

    public static function createDictionary($config, $rawWords, $verbose)
    {
        $dictionary = new \StdClass();
        $dictionary->index = [];
        $dictionary->words = [];
        $dictionary->derived = [];
        foreach ($rawWords as $wordKey=>$wordData) {
            $dictionary->words[$wordKey] =
                new \WorldlangDict\Word(
                    $config,
                    $rawWords,
                    $wordKey,
                    $dictionary
                );
            if ($verbose && (count($dictionary->words)%100==0)) {
                echo count($dictionary->words)." ";
            }
        }
        if ($verbose) {
            echo "<p> ... Saved ".count($dictionary->words)." words.</p>";
        }
        foreach ($dictionary->index as $lang=>$indexList) {
            ksort($dictionary->index[$lang]);
        }
        foreach ($dictionary->tags as $tag=>$words) {
            ksort($dictionary->tags[$tag]);
        }
        ksort($dictionary->tags);
        Word::generateRelatedWords($dictionary);
        return $dictionary;
    }


    private static function extractWords($source)
    {
        $nestedBracket = 0;
        $nestedUnderscore = 0;
        $result = [];

        foreach ($source as $fragment) {
            $subfrags = explode('; ', $fragment);

            if (sizeof($subfrags)>1) {
                $newWords = Word::extractWords($subfrags);
                $result = array_merge($result, $newWords);
            } else {
                $result[] = preg_replace("/[^a-zA-Z 0-9]+/", " ", trim($fragment));
            }
        }
        return $result;
    }

    private function generateIpa($config)
    {
        $phrase = strtolower($this->term);
        $phrase = Word::addStressToWord($phrase);
        /*
        c - 't͡ʃ'
        j - 'dʒ'
        r - 'ɾ'
        x - 'ʃ'
        y - 'j'
        h - 'x'
        */
        $result = preg_replace(REPLACE_GLB_REGEX, REPLACE_IPA, $phrase);
        $result = "http://ipa-reader.xyz/?text=".$result."&voice=Ewa";
        $this->ipaLink = $result;
    }



    // As per docuentation for JavaScript function AddStressToWord():
    // https://github.com/ShawnPConroy/WorldlangDict/blob/e10709c9fe319d991a9c787f46c2e1cbeaabc2b4/templates/menalar/js/ipa.js#L270
    public static function addStressToWord($word = null) {
        // Skip Rule
        if (in_array($word, WORDS_TO_SKIP)) {
            return $word;
        }
        else if (empty($word)) {
            return "";
        }
        // Single vowel rule (or no vowels)
        $vowels = preg_match_all(GLOBAL_VOWEL_REGEX, $word);
        if ($vowels == false) {
            return $word;
        }
        else if ($vowels == 1) {
            return STRESS_MARKER . $word;
        }
        
        // Vowel Select Rule
        $wordlet = substr($word, 0, -1);
        preg_match(FINAL_VOWEL_REGEX, $wordlet, $match);
        
        $pos = strrpos($wordlet, $match[0]);
        $adj1 = $word[$pos - 1];
        $adj2 = $word[$pos - 2];

        // Shift Rules
        $shift = -1;

        if ($pos == 0 || in_array($adj1, NO_SHIFT_CHARS)) {
            $shift = 0;
        }
        else if (
            ($adj1 == 'y' || $adj1 == 'w') &&
            ($adj2 != 'y' && $adj2 != 'w' && !in_array($adj2, NO_SHIFT_CHARS) )
        ) {
            $shift = -2;
        }
        else if (($adj1 == 'r' || $adj1 == 'l') &&
            in_array($adj2, ONSET_CONSONANTS)
        ) {
            $shift = -2;
        }

        // don't shift beyond the first letter
        if ($pos + $shift < 0) {
            $shift = - $pos;
        }

        return substr($word, 0, $pos + $shift) . STRESS_MARKER . substr($word, $pos + $shift);
    }

    // Should this be makeRelatedWords ?
    // Take $relatedWords from etymoloy and add any logged afixes
    public static function generateRelatedWords($d)
    {
        foreach ($d->words as $i=>$cur) {
            if (isset($d->derived[$i])) {
                foreach ($d->derived[$i] as $word) {
                    $d->words[$i]->relatedWords[] = $word;
                }
            }
        }
    }

    private function generateSearchTerms($worldlang, $d, $searchTerms)
    {
        $this->generateWorldlangTerms($worldlang, $d);
        $this->generateNatlangTerms($worldlang, $d);
        if (!empty($searchTerms)) {
            $searchTerms = explode(',', $searchTerms);
            foreach ($searchTerms as $term) {
                $term = trim($term);
                $d->index['eng'][$term][$this->termIndex] = $this->termIndex;
            }
        }
    }

    private function generateNatlangTerms_old($worldlang, $d)
    {
        $pd = new \Parsedown();
        foreach ($this->translation as $lang=>$trans) {
            // Remove anything between brackets [{) or _underscore_ markdown.
            // Needs to remove parenthese first because in some cases with
            // italic and bold in parentheses it doesn't remove all text
            $trans = preg_replace('/[\(].*[\)]/U', '', $trans);
            $trans = preg_replace('/[\[{\_].*[\]}\_]/U', '', $trans);
            $trans = explode(', ', $trans);
            $trans = Word::extractWords($trans);
            foreach ($trans as $naturalWord) {
                $naturalWord = strtolower(trim($naturalWord));
                if (!empty($naturalWord)) {
                    $d->index[$lang][$naturalWord][$this->termIndex] =
                        $this->termIndex;
                }
            }
            $this->translation[$lang] = $pd->line($this->translation[$lang]);
        }
        return;
    }


    private function generateNatlangTerms($worldlang, $d) {

        $pd = new \Parsedown();
        foreach ($this->translation as $lang=>$trans) {
            $trans = preg_replace('/\(_(.+)_\)/U', '', $trans);     // (_ ... _)
            $trans = preg_replace('/_\*\*(.+)\*\*_/U', '', $trans); // _** ... **_
            $trans = preg_replace('/\[.+\].+\]/U', '', $trans); // [...[...]...]
            // If we also need to do single bracket: /\[.+\]/U
            $tok = trim(strtok($trans, constant("TRANS_SEPERATORS")));
            while (!empty($tok)) {
                if ($tok[0] == '_' && $tok[-1] != '_') {
                    $tok .= ','.strtok(constant("TRANS_SEPERATORS"));
                }

                // included all parts, removing parentheses and underscores.
                $searchTerm = trim(preg_replace('/[\(\)_]/U', '', $tok));     // (_ ... _)
                $searchTerm = strtolower(trim($searchTerm));
                $d->index[$lang][$searchTerm][$this->termIndex] = $this->termIndex;

                // Remove optional parts by deleting what is inside the
                // brackets and removing double white space.
                if (strpos($tok, '(') !== false) {
                    $searchTerm = preg_replace('/\((.+)\)/U', '', $tok);
                    $searchTerm = preg_replace('/\s\s+/', ' ',$searchTerm);
                    $searchTerm = strtolower(trim($searchTerm));
                    $d->index[$lang][$searchTerm][$this->termIndex] = $this->termIndex;
                }
                $tok = strtok(constant("TRANS_SEPERATORS"));
            }
            $this->translation[$lang] = $pd->line($this->translation[$lang]);
        }
    }

    private function generateWorldlangTerms($worldlang, $d)
    {
        // Add full term to search terms
        $d->index[$worldlang][$this->termIndex][$this->termIndex] = $this->termIndex;
        // If has optional part, remove and add to index
        if (strpos($this->term, "(") !== false) {
            // Add to index the full term without brackets
            $searchTerm =
                trim(preg_replace('/[^A-Za-z0-9 \-]/', '', $this->term));
            $d->index[$worldlang][$searchTerm][$this->termIndex] = $this->termIndex;
            // Adds shortened term, removing bracketted text
            $searchTerm =
                trim(preg_replace('/[\[{\(_].*[\]}\)_]/U', '', $this->term));
            $d->index[$worldlang][$searchTerm][$this->termIndex] = $this->termIndex;
        }

        // Add all terms not in brackets
        $words = explode(
            ' ',
            preg_replace('/[\[{\(_].*[\]}\)_]/U', '', $this->term)
        );
        foreach ($words as $word) {
            $d->index[$worldlang][$word][$this->termIndex] = $this->termIndex;
        }
    }

    // log root of derived words and generate etymology links
    private function parseEtymology_old($config, &$d)
    {
        $terms = [];
        $links = [];
        if (!empty($this->etymology)) {
            // Find related words if it does not refernce other languages in ().
            if (strpos($this->etymology, '(') === false) {
                if (substr($this->etymology, 0, 6) == "Am oko") {
                    // Remove 'am oko' and formatting for links.
                    $etymology = preg_replace('/[^A-Za-z0-9, \-]/', '', substr($this->etymology, 7));
                } else {
                    $etymology = $this->etymology;
                }

                // Replace + and , with | and explode on that to get words
                // $this->relatedWords = explode('|', str_replace([" + ",", "], "|", $etymology));
                $termList = explode('|', str_replace([" + ",", "], "|", $etymology));
                foreach ($termList as $word) {
                    $d->derived[strtolower($word)][$this->termIndex] = $this->term;
                    $links[$word] = '<a href="../lexi/'.$word.'">'.$word.'</a>';
                    $terms[$word] = $word;
                }
            }
            $pd = new \Parsedown();
            $this->etymology = $pd->line(str_replace($terms, $links, $this->etymology));
        }
    }

    // Parse the etymology field and create formatting etymology and log this
    // as a derived word. Skip if this field is listing languages rather
    // than being derived. If it has any parentheses its a borrowed word, skip.
    private function parseEtymology($config, &$d)
    {
        $startsHttp = substr($this->etymology, 0, 7);
        
        if (strcmp($startsHttp, 'https:/') == 0 || strcmp($startsHttp, 'http://') == 0) {
            $startsHttp = true;
        }
        else {
            $startsHttp = false;
        }


        $etymology = [];
        if (!empty($this->etymology) && (strpos($this->etymology, '(') === false) && !$startsHttp) {
            // Not borrowed, so find mentioned terms. Break in to fragments and
            // rebuild fragment by fragment. When reaching term index and link
            // where applicable.
            $frag = explode(' ', $this->etymology);
            $phrase = '';
            $seperator = '';
            $phraseStart = false;

            foreach ($frag as $word) {
                // Check if end of phrase (or term). The end is reach when $word
                // is a `+` or ends with a `,`, is the oko of the `Am oko` or the
                // priori_ of `_a priori_`
                $stop = '';

                if ($word == '+') {
                    $word = '';
                    $stop = ' + ';
                    $phraseStart = true;
                } else if (substr($word, -1) == ',') {
                    $word = substr($word, 0, -1);
                    $stop = ', ';
                    $phraseStart = true;
                } else if (substr($word, -1) == '.') {
                    $word = substr($word, 0, -1);
                    $stop = '.';
                } else if ($word == 'oko' || $word == 'priori_') {
                    $tempPhrase = $phrase.' '.$word;
                    // die();
                    if ($tempPhrase == 'Am oko') {
                        $etymology[] = $phrase.' '.$word.' ';
                        $phrase = '';
                        $seperator = '';
                        $stop = '';
                        $word = '';
                    } else if ($tempPhrase == '_a priori_') {
                        $etymology[] = $phrase.' '.$word;
                        $phrase = '';
                        $seperator = '';
                        $stop = '';
                        $word = '';
                    }
                }

                if (empty($stop)) {
                    $phrase .= (!$phraseStart?$seperator:'').$word;
                    $phraseStart = false;
                } else {
                    $phrase .= $word;
                    $phrase = preg_replace('/[^A-Za-z0-9, \-]/', '', $phrase);

                    // log as a derived term
                    $d->derived[strtolower($phrase)][$this->termIndex] = $this->term;
                    // link to term
                    $phrase = '<a href="../lexi/'.$phrase.'">'.$phrase.'</a>';
                    // add to etymology
                    $etymology[] = $phrase.$stop;
                    $phrase = '';
                }
                $seperator = ' ';
                $stop = '';
            }

            // clean up if !empty($phrase)
            // exactly as above: log, link, add
            if (!empty($phrase)) {
                // log as a derived term
                $d->derived[strtolower($phrase)][$this->termIndex] = $this->term;
                // link to term
                $phrase = '<a href="../lexi/'.$phrase.'">'.$phrase.'</a>';
                // add to etymology
                $etymology[] = $phrase;
            }
            $this->etymology = implode($etymology);
        }

        $pd = new \Parsedown();
        if (!$startsHttp) {
            $this->etymology = $pd->line($this->etymology);
        }
    }

    private function parseSynAnt($rawWord)
    {
        if (!empty($rawWord['Synonyms'])) {
            $this->synonyms = explode(', ', $rawWord['Synonyms']);
        }
        if (!empty($rawWord['Antonyms'])) {
            $this->antonyms = explode(', ', $rawWord['Antonyms']);
        }
    }

    private function parseTags($config, $d)
    {
        if (!empty($this->tags)) {
            $this->tags = explode(',', $this->tags);
            foreach ($this->tags as $i=>$tag) {
                $tag = strtolower(trim($tag));
                if (isset($d->words[$tag])) {
                    $tagName = $d->words[$tag]->term;
                } else {
                    $tagName = $tag;
                }
                $this->tags[$i]=$tagName;
                $d->tags[$tag][$this->termIndex] = $this->term;
            }
        }
    }

    private function processEntryList($words)
    {
        if (!empty($words) > 0) {
            $words = explode(";", $words);
            foreach ($words as $index=>$word) {
                $words[$index] = trim($word);
            }
            return $words;
        } else {
            return null;
        }
    }

    public static function saveDictionary($config, $dictionary)
    {
        $fp = fopen($config->serializedLocation, 'w');
        fwrite($fp, serialize($dictionary));
        fclose($fp);

        yaml_emit_file($config->YamlLocation, $dictionary);

        $fp = fopen($config->JsonLocation, 'w');
        fwrite($fp, json_encode($dictionary, JSON_UNESCAPED_UNICODE));
        fclose($fp);

        $fp = fopen($config->JsLocation, 'w');
        fwrite($fp, "var dictionary = ".json_encode($dictionary));
        fclose($fp);
    }
}
