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
                    // TODO: Remove this is because of the correction of a bug
                    if (empty($word)) continue;
                    $page->content .=
                        '<li>'.
                        WorldlangDictUtils::makeLink(
                            $config,
                            'leksi/'.urlencode($word),
                            $request,
                            $word).
                        '<br/>'.
                        $config->dictionary->words[$word]
                            ->translation[$config->lang].
                        '</li>';
                } else {
                    if (count($config->dictionary->index[$config->lang][$word]) == 1) {
                        $def = $config->dictionary->words[current($config->dictionary->index[$config->lang][$word])]
                            ->translation[$config->lang]."!";
                    } else {
                        $def = implode(', ', $config->dictionary->index[$config->lang][$word]);
                    }
                    $page->content .= '<li>'.
                        WorldlangDictUtils::makeLink(
                            $config,
                            'cel-ruke/'.urlencode($word),
                            $request,
                            $word).
                        '<br/>'.$def.'</li>';
                }
            }
            $page->content .= '</ul>';
        } else {
            // Otherwise, say nothing was found.
            $page->content .= $config->getTrans('no matches found');
        }
    }
}
