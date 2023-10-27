<?php
namespace WorldlangDict;

class WordView
{
    public static function dictionaryEntry($config, $request, $word, &$page)
    {
        $page->description = $word->term . ': ' . htmlspecialchars($word->translation[$config->lang]);
        $page->content .='
            <div id="'.$word->term.'" class="dictionaryEntry w3-card" data-search="'./*implode(' ', $word->searchText).*/'" >
            <header class="w3-container">
                <h2 id="entryTerm">'.$word->term.'</h2>';
        if (!empty($word->wordClass)) {
            $page->content .= '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase">'.$word->wordClass.'</a>)</div>';
        }
        $page->content .='
                </header>
            <div class="w3-container">
            <p class="definition">'.
                (!empty($word->translation[$config->lang]) ? $word->translation[$config->lang] : sprintf($config->getTrans("Missing Word Translation") ) ).
                '</p>';
        if (!empty($word->synonyms)) {
            $words = [];
            if (count($word->synonyms) == 1) {
                $trans = 'synonym sentence';
            } else {
                $trans = 'synonyms sentence';
            }
            foreach ($word->synonyms as $cur) {
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
        if (!empty($word->antonyms)) {
            $words = [];
            if (count($word->antonyms) == 1) {
                $trans = 'antonym sentence';
            } else {
                $trans = 'antonyms sentence';
            }
            foreach ($word->antonyms as $cur) {
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

        if (!empty($word->example)) {
            $page->content .='
                <p class="example">'.sprintf($config->getTrans('Example'), $word->example).'</p>';
        }
        if (!empty($word->etymology)) {

            $startsHttp = substr($word->etymology, 0, 7);
            
            if (strcmp($startsHttp, 'https:/') == 0 || strcmp($startsHttp, 'http://') == 0) {
                $word->etymology = '<a href="'.$word->etymology.'">'.$config->getTrans('etymology link').'</a>';
            }
            else {
            }
    
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), $word->etymology).'</p>';
        }
        if (!empty($word->relatedWords)) {
            foreach ($word->relatedWords as $i=>$cur) {
                $word->relatedWords[$i] = WorldlangDictUtils::makeLink(
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
                    implode(', ', $word->relatedWords)
                ).'</p>';
        }
        
        if (!empty($word->tags)) {
            foreach ($word->tags as $i=>$tag) {
                $word->tags[$i] = WorldlangDictUtils::makeLink(
                    $config,
                    "lexilari/".$tag,
                    $request,
                    $tag
                );
            }
            $page->content .= '
                <p class="tags">'.sprintf(
                $config->getTrans('tags links'),
                implode(', ', $word->tags)
            ).'</p>
                    ';
        }
        
        $page->content .= '</div>';
        if (isset($request->options['full'])) {
            $page->content .= '<div style="text-align: left; color: black">';
            foreach ($word->wordSource as $key=>$data) {
                $page->content .= '<p><strong style="color: black">'.$key . '</strong>: '. $data. "</p>";
            }
            $page->content .= '</div>';
        }
        
        $page->content .=
            '<footer class="w3-container">
            '.WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.$word->term,
                $request,
                '<span class="fa fa-link"></span> '.
                    $config->getTrans('Word Link')
            ).'
            &bull; '.
            '<a href="'.$word->ipaLink.'"><span class="fa fa-volume-up"></span> '.$config->getTrans('ipa link').'</a>
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
