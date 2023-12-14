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
            $entry['trans html'][$config->lang].
            '</dd>';

        return $result;
    }


    /**
     * Create a <DD>/<DT> pair based on API2
     */
    public static function entry_to_dl_pair_string(object $config, object $request, string $term, array $data) {
        if (empty($term)) return "";
// category shoudl chagne proper noun to proper word
        if (strcmp($data['category'], "proper noun") == 0) {
            $data['category'] = "proper word";
        }
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

}
