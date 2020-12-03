<?php
namespace WorldlangDict;

class SearchView
{
    public static function resultsTitle($config, $request, $page)
    {
        $page->content .= '<h3 style="color: black">'.
            $config->getTrans('search result title').': '.
            $request->options['wterm'].' '.
            $request->options['nterm'].'</h3>';
    }

    public static function results($config, $partialMatches, $lang, $request, $page)
    {
        // var_dump($partialMatches);
        // if found, Ask which they want.
        if (sizeof($partialMatches)) {
            $page->content .= '<ul class="dictionaryList">';

            foreach ($partialMatches as $word) {
                // var_dump($word);
                if ($lang=='glb') {
                    $page->content .= '<li>'.
                        WorldlangDictUtils::makeLink($config, 'lexi/'.urlencode($word), $request, $word).
                        '<br/>'.$config->dictionary->words[$word]->translation[$config->lang].'</li>';
                } else {
                    if (count($config->dictionary->index[$lang][$word]) == 1) {
                        $word = current($config->dictionary->index[$lang][$word]);
                        $def = $config->dictionary->words[$word]->translation[$lang];
                        $page->content .= '<li>'.
                            WorldlangDictUtils::makeLink($config, 'cel-ruke/'.urlencode($word), $request, $word).
                            '<br/>'.$def.'</li>';
                    } else {
                        foreach($config->dictionary->index[$lang][$word] as $word) {
                            $page->content .= '<li>'.
                            WorldlangDictUtils::makeLink($config, 'lexi/'.urlencode($word), $request, $word).
                            '<br/>'.$config->dictionary->words[$word]->translation[$config->lang].'</li>';
                        }
                    }
                }
            }
            $page->content .= '</ul>';
        } else {
            // Otherwise, say nothing was found.
            $page->content .= $config->getTrans('no matches found');
        }
    }
}
