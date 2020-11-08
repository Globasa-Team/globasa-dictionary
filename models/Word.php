<?php
namespace WorldlangDict;

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


    // added before online.
    // Create object from CSV dictionary array
    public function __construct($config, $rawWords, $wordKey, $d)
    {
        $this->term       = $rawWords[$wordKey]['Word'];
        $this->termIndex  = $wordKey;
        $this->category   = $rawWords[$wordKey]['Category'];
        $this->part       = $rawWords[$wordKey]['Part Of Speech'];
        $this->etymology  = $rawWords[$wordKey]['LeksiliAsel'];
        $this->tags       = $rawWords[$wordKey]['Tags'];
        $this->example    = $rawWords[$wordKey]['Example'];

        $this->translation['eng'] = $rawWords[$wordKey]['TranslationEng'];
        $this->translation['fra'] = $rawWords[$wordKey]['TranslationFra'];
        $this->translation['rus'] = $rawWords[$wordKey]['TranslationRus'];
        $this->translation['spa'] = $rawWords[$wordKey]['TranslationSpa'];
        $this->translation['zho'] = $rawWords[$wordKey]['TranslationZho'];

        $this->parseEtymology($config, $d);
        $this->parseTags($config, $d);
        $this->parseSynAnt($rawWords[$wordKey]);
        $this->generateSearchTerms($config->worldlang, $d);
        $this->generateIpa($config);
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
        /*
        c - 'tʃ'
        j - 'dʒ'
        r - 'ɾ'
        x - 'ʃ'
        y - 'j'
        h - 'x'
        */
        $pattern     = [ '/c/', '/j/', '/r/', '/x/', '/y/', '/h/' ];
        $replacement = [ 'tʃ',  'dʒ',   'ɾ',   'ʃ',   'j',   'x'  ];
        $result = preg_replace($pattern, $replacement, $phrase);
        $result = "http://ipa-reader.xyz/?text=".$result."&voice=Carla";
        $result = '<a href="'.$result.'"><span class="fa fa-volume-up"></span> '.$config->getTrans('ipa link').'</a>';
        $this->ipaLink = $result;
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

    private function generateSearchTerms($worldlang, $d)
    {
        $this->generateWorldlangTerms($worldlang, $d);
        $this->generateNatlangTerms($worldlang, $d);
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
/*
am: _imperative verb marker_
-bel: _short for_ (/eng/leksi/-bil): -ible
    - Has multiple links in it.
    - hataya also does it.
-cu: _intransitive verb marker_
-do:  _in an inactive state of_
-gi: _**n/v.tr sfx**_ _causative, transitive marker_, make, cause to be
-mo: _adverb of degree and manner_
-ner: near (_used only with_ (/eng/leksi/xa-))
-su: _possessive adjective marker_
am: _imperative verb marker_
be-: _passive voice marker_
infer: _**n**_  _short for [infraya](/eng/leksi/infraya)_: inferiority, belowness
kuloka: _subordinate clause_: where
kumaner: _subordinate clause_: how
kuseba: _subordinate clause_: why
kusu: _subordinate clause_: whose
kute: _subordinate clause_: who
kuto: _subordinate clause_: which
kuwatu: _subordinate clause_: when
max kom: _det phrs_ more than
maxmo kom: _det phrs_ more than
megagon: _**n**_ megagon, 1,000,000-gon
min kom: _det phrs_ fewer than
nun: _present tense marker_
of-: _forms fractions_
plu: _**adj/adv**_  multiple, _plurality marker_
plu-: _multiple_
se: _**pron**_ _reflexive pronoun_, myself, yourself, herself, himself, itself, themselves, ourselves, yourselves
su: _**part**_ _marks the genitive case_
_**n**_  _short for [supraya](/eng/leksi/supraya)_: superiority, aboveness
wal: _**prep**_ without (not using/having)

xosu
    few
    (a) little (bit of)
    (a) bit (of)


*/
    private function generateNatlangTerms($worldlang, $d) {
        $pd = new \Parsedown();
        echo $this->term;
        foreach ($this->translation as $lang=>$trans) {
            $trans = preg_replace('/\(_(.+)_\)/U', '', $trans);     // (_ ... _)
            $trans = preg_replace('/_\*\*(.+)\*\*_/U', '', $trans); // _** ... **_
            $trans = preg_replace('/\[.+\].+\]/U', '', $trans); // [...[...]...]
            // If we also need to do single bracket: /\[.+\]/U
            $tok = strtok($trans, ",;/");
            while ($tok !== false) {
                if ($lang == 'eng') echo "<li>$tok</li>";
                $tok = strtok(",;/");
            }
        }
        $this->translation[$lang] = $pd->line($this->translation[$lang]);
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
                    $links[$word] = '<a href="../leksi/'.$word.'">'.$word.'</a>';
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
        $etymology = [];
        if (!empty($this->etymology) && (strpos($this->etymology, '(') === false)) {
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
                    $phrase .= ' '.$word;
                    // die();
                    if ($phrase == 'Am oko') {
                        $etymology[] = $phrase.' ';
                        $phrase = '';
                        $seperator = '';
                        $stop = '';
                        $word = '';
                    } else if ($phrase == '_a priori_') {
                        $etymology[] = $phrase;
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
                    // log as a derived term
                    $d->derived[strtolower($phrase)][$this->termIndex] = $this->term;
                    // link to term
                    $phrase = '<a href="../leksi/'.$phrase.'">'.$phrase.'</a>';
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
                $phrase = '<a href="../leksi/'.$phrase.'">'.$phrase.'</a>';
                // add to etymology
                $etymology[] = $phrase;
            }
            $this->etymology = implode($etymology);
        }
        $pd = new \Parsedown();
        $this->etymology = $pd->line($this->etymology);
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
