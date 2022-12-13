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
        // Show matches
        if (sizeof($partialMatches)) {
            
            foreach ($partialMatches as $word) {
                $word = strtolower($word);
                
                if ($lang=='glb') {
                    $listing[$word] = SearchView::entryToString($config, $request, $word);
                } else {
                    foreach($config->dictionary->index[$lang][$word] as $word) {
                        $listing[$word] = SearchView::entryToString($config, $request, $word);
                    }
                }
            }
            ksort($listing);

            $page->content .= '<dl class="dictionaryList">'.implode($listing)."</dl>";
            // Changing from ul to dl so removing this:
            // $page->content .= '<ul class="dictionaryList">';
            // $page->content .= implode($listing);
            // $page->content .= '</ul>';
        } else {
            // Otherwise, say nothing was found.
            $page->content .= $config->getTrans('no matches found');
        }
    }

    private static function entryToString($config, $request, $word) {
        $result = '<dt>'.
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($word),
                $request,
                $config->dictionary->words[$word]->term
            );
        if (isset($config->dictionary->words[$word]->wordClass) && !empty($config->dictionary->words[$word]->wordClass)) {
            $result .=
                '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/grammar/word-classes">'.$config->dictionary->words[$word]->wordClass.'</a>)</div>';
        }
        $result .=
            '</dt><dd>'.
            $config->dictionary->words[$word]->translation[$config->lang].
            '</dd>';

        return $result;
    }
}
