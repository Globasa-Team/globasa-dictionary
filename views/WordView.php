<?php
namespace WorldlangDict;

class WordView
{
    public static function dictionaryEntry(object $config, object $request, array $entry, object &$page)
    {
        $page->description = $entry['term'] . ': ' . htmlspecialchars($entry['raw data']['trans'][$config->lang]);
        $page->content .='
            <div id="'.$entry['term'].'" class="dictionaryEntry w3-card" data-search="'./*implode(' ', $entry['searchText']).*/'" >
            <header class="w3-container">
                <h2 id="entryTerm">'.$entry['term'].'</h2>';
        if (!empty($entry['word class'])) {
            $page->content .= '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase">'.$entry['word class'].'</a>)</div>';
        }
        $page->content .='
                </header>
            <div class="w3-container">
            <p class="definition">'.
                (!empty($entry['raw data']['trans'][$config->lang]) ? $entry['raw data']['trans'][$config->lang] : sprintf($config->getTrans("Missing Word Translation") ) ).
                '</p>';
        if (!empty($entry['synonyms'])) {
            $words = [];
            if (count($entry['synonyms']) == 1) {
                $trans = 'synonym sentence';
            } else {
                $trans = 'synonyms sentence';
            }
            foreach ($entry['synonyms'] as $cur) {
                $words[] = WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.$cur,
                    $request,
                    $cur
                );
            }
            $page->content .='
                <p>'.sprintf($config->getTrans($trans), implode(', ', $words)).'</p>';
        }
        if (!empty($entry['antonyms'])) {
            $words = [];
            if (count($entry['antonyms']) == 1) {
                $trans = 'antonym sentence';
            } else {
                $trans = 'antonyms sentence';
            }
            foreach ($entry['antonyms'] as $cur) {
                $words[] = WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.$cur,
                    $request,
                    $cur
                );
            }
            $page->content .='
                <p>'.sprintf($config->getTrans($trans), implode(', ', $words)).'</p>';
        }

        if (!empty($entry['example'])) {
            $page->content .='
                <p class="example">'.sprintf($config->getTrans('Example'), $entry['example']).'</p>';
        }
        if (!empty($entry['raw data']['etymology'])) {

            $startsHttp = substr($entry['raw data']['etymology'], 0, 7);
            
            if (strcmp($startsHttp, 'https:/') == 0 || strcmp($startsHttp, 'http://') == 0) {
                $entry['raw data']['etymology'] = '<a href="'.$entry['etymology'].'">'.$config->getTrans('etymology link').'</a>';
            }
            else {
            }
    
            // $page->content .='
            //     <p class="etymology">RAW ETYMOLOGY - '. $entry['raw data']['etymology'].'</p>';
        }
        //var_dump($entry['etymology']);
        if (isset($entry['etymology']['derived'])) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), $entry['raw data']['etymology']).'</p>';

        }       
        if (isset($entry['etymology']['natlang'])) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), "").'</p>
                <ul style="list-style:none;">'.self::list_langs_and_examples($entry['etymology']['natlang']).'</ul>';
        }
        if (isset($entry['etymology']['am kompara'])) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), "Am kompara").'</p>
                <ul style="list-style:none;">'.self::list_to_ul($entry['etymology']['am kompara']).'</ul>';

        }
        if (isset($entry['etymology']['am pia oko'])) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), 'Am pia oko').'</p>
                <ul style="list-style:none;">'.self::list_langs_and_examples($entry['etymology']['am pia oko']).'</ul>';

        }
        if (isset($entry['etymology']['am oko'])) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), 'Am oko').'</p>
                <ul style="list-style:none;">'.self::list_to_ul($entry['etymology']['am oko']).'</ul>';

        }
        if (isset($entry['etymology']['kwasilexi'])) {
            $page->content .='
                <p class="etymology">kwasilexi</p>
                <ul style="list-style:none;">'.self::list_langs_and_examples($entry['etymology']['kwasilexi']).'</ul>';



        }
        if (isset($entry['etymology']['link'])){
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), $entry['etymology']['link']).'</p>';

        }
        if (!empty($entry['relatedWords'])) {
            foreach ($entry['relatedWords'] as $i=>$cur) {
                $entry['relatedWords'][$i] = WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.$cur,
                    $request,
                    $cur
                );
            }
            $page->content .= '
                <p class="alsosee">'.
                sprintf(
                    $config->getTrans(
                        'Also See Sentence'
                    ),
                    implode(', ', $entry['relatedWords'])
                ).'</p>';
        }
        
        if (!empty($entry['tags'])) {
            foreach ($entry['tags'] as $i=>$tag) {
                $entry['tags'][$i] = WorldlangDictUtils::makeLink(
                    $config,
                    "lexilari/".$tag,
                    $request,
                    $tag
                );
            }
            $page->content .= '
                <p class="tags">'.sprintf(
                $config->getTrans('tags links'),
                implode(', ', $entry['tags'])
            ).'</p>
                    ';
        }
        
        $page->content .= '</div>';
        if (isset($request->options['full'])) {
            $page->content .= '<div style="text-align: left; color: black">';
            foreach ($entry['wordSource'] as $key=>$data) {
                $page->content .= '<p><strong style="color: black">'.$key . '</strong>: '. $data. "</p>";
            }
            $page->content .= '</div>';
        }
        
        $page->content .=
            '<footer class="w3-container">
            '.WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.$entry['term'],
                $request,
                '<span class="fa fa-link"></span> '.
                    $config->getTrans('Word Link')
            ).'
            &bull; '.
            '<a href="'.$entry['ipa link'].'"><span class="fa fa-volume-up"></span> '.$config->getTrans('ipa link').'</a>
            </footer>
            </div>
            ';
    }

    

    public static function entryToDtString($config, $request, $word) {
        if (empty($word->term)) return "";

        $letter = ctype_alpha($word->termIndex[0]) ? $word->termIndex[0] : $word->termIndex[1];
        $data = " data-class=\"{$word->wordClass}\" data-category=\"{$word->category}\" data-char=\"{$letter}\" ";
        $result = "<dt {$data}>".
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($word->term),
                $request,
                $word->term
            );
        if (isset($word->wordClass) && !empty($word->wordClass)) {
            $result .=
                '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase">'.$word->wordClass.'</a>)</div>';
        }
        $result .=
            "</dt><dd {$data}>".
            $word->translation[$config->lang].
            '</dd>';

        return $result;
    }


    /**
     * Create a <DD>/<DT> pair based on API2
     */
    public static function entry_to_dl_pair_string(object $config, object $request, string $term, array $data) {
        if (empty($term)) return "";

        $letter = ctype_alpha($term[0]) ? $term[0] : $term[1];
        $attributes = " data-class=\"{$data['class']}\" data-category=\"{$data['category']}\" data-char=\"{$letter}\" ";
        $result = "<dt {$attributes}>".
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($term),
                $request,
                $term
            );
        if (isset($data['class']) && !empty($data['class'])) {
            $result .=
                '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase">'.$data['class'].'</a>)</div>';
        }
        $result .=
            "</dt><dd {$attributes}>".
                $data['translation'].
            '</dd>';

        return $result;
    }

    
    public function addList($config, $request, &$page)
    {
        foreach ($config->dictionary->words as $wordIndex=>$entry) {
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($list->listLang != "glb") {
                    $page->content .= '<h1>'.
                        sprintf(
                            $config->getTrans('Entry for'),
                            $wordIndex,
                            $list->lang
                        ).'</h1>';
                }
                WordView::DictionaryEntry($config, $request, $entry, $page);
            } else {
                if ($list->listLang != $config->worldlang) {
                    $page->content .= '<h1>'.
                        sprintf(
                            $config->getTrans('Entries for'),
                            $wordIndex,
                            $list->lang
                        ).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $page->content .= $subEntry->getReverse();
                }
            }
        }
    }

    private static function list_langs_and_examples(array $list):string {
        $result = "";
        foreach($list as $lang=>$example) {
            $result .= "<li style=\"display:inline-block; margin: 2px;\"><span class=\"w3-tag w3-round w3-dark-grey\" style=\"padding:3px;\">{$lang}";
            if (!empty($example)) $result .= " <span class=\"w3-tag w3-round w3-border-white w3-light-grey\">{$example}</span>";
            $result .= "</span></li>";
        }
        return $result;
    }

    private static function list_to_ul(array $list):string {
        $result = "";
        foreach($list as $item) {
            $result .= "<li style=\"display:inline-block; margin: 2px;\"><span class=\"w3-tag w3-round w3-dark-grey\" style=\"padding:3px;\">{$item}</span></li>";
        }
        return $result;
    }

    public static function tags($config, $request, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('tags title').'</h1>';

        if (isset($request->arguments[0]) && isset($config->dictionary->tags[$request->arguments[0]])) {
            $tags[$request->arguments[0]] = $config->dictionary->tags[$request->arguments[0]];
        } else {
            $tags = $config->dictionary->tags;
        }
        foreach ($tags as $tag=>$words) {
            foreach ($words as $i=>$word) {
                $words[$i] = WorldlangDictUtils::makeLink($config, "lexi/".$word, $request, $word);
            }

            if (isset($config->dictionary->words[$tag])) {
                $term = $config->dictionary->words[$tag]->term;
                $def = '
                <p>'.$config->dictionary->words[$tag]->translation[$request->lang].'</p>
                ';
            } else {
                $term = $tag;
                $def = "";
            }
            if (!empty($words)) {
                $tags = '
                <p class="tags">'.implode(', ', $words).'</p>';
            } else {
                $tags = "";
            }
            $page->content .= '
                <div class="w3-card">
                <header class="w3-container"><h2>'.$term.'</h2></header>
                    <div class="w3-container">'.
                    $def.
                    $tags.'
                    </div>
                </div>
                ';
        }
    }
}
