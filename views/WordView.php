<?php
namespace WorldlangDict;

class WordView
{

    public static function entry_to_dt_string(WorldlangDictConfig $config, Request $request, array $entry):string {
        if (empty($entry['term'])) return "";

        $letter = ctype_alpha($entry['slug'][0]) ? $entry['slug'][0] : $entry['slug'][1];
        $data = " data-class=\"{$entry['word class']}\" data-category=\"{$entry['category']}\" data-char=\"{$letter}\" ";
        $result = "<dt {$data}>".
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($entry['slug']),
                $request,
                $entry['term']
            );
        if (isset($entry['word class']) && !empty($entry['word class'])) {
            $result .=
                '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase">'.$entry['word class'].'</a>)</div>';
        }
        $result .=
            "</dt><dd {$data}>".
            $entry['raw data']['trans'][$config->lang].
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

    public static function list_langs_and_examples(array $list):string {
        $result = "";
        foreach($list as $lang=>$example) {
            $result .= "<li style=\"display:inline-block; margin: 2px;\"><span class=\"w3-tag w3-round w3-dark-grey\" style=\"padding:3px;\">{$lang}";
            if (!empty($example)) $result .= " <span class=\"w3-tag w3-round w3-border-white w3-light-grey\">{$example}</span>";
            $result .= "</span></li>";
        }
        return $result;
    }

    public static function list_to_ul(array $list):string {
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
