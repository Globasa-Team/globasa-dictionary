<?php
namespace WorldlangDict;

class SearchView
{
    public static function results($config, $partialMatches, $lang, $request, $page)
    {
        // if found, Ask which they want.

        $page->content .= '<h3 style="color: black">'.$config->getTrans('search result title').': '.$request->options['wterm'].' '.$request->options['nterm'].'</h3>';
        if (sizeof($partialMatches)) {
            $page->content .= '<ul>';

            foreach ($partialMatches as $word) {
                if ($lang=='glb') {
                    $page->content .= '<li>'.WorldlangDictUtils::makeLink($config, 'leksi/'.urlencode($word), $word).'<br/>'.$dict[$lang][$word]['Definition'.$config->langCap].'</li>';
                } else {
                    if (strpos($dict[$lang][$word], ',') === false) {
                        $def = $dict['glb'][$dict[$lang][$word]]['Definition'.$config->langCap];
                    } else {
                        $def = $dict[$lang][$word];
                    }
                    $page->content .= '<li>'.WorldlangDictUtils::makeLink($config, 'cel-ruke/'.urlencode($word), $word).'<br/>'.$def.'</li>';
                }
            }
            $page->content .= '</ul>';
        } else {
            // Otherwise, say nothing was found.
            $page->content .= $config->getTrans('no matches found');
        }
    }
}
