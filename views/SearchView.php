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
                    $listing[$word] = WordView::entryToDtString($config, $request, $config->dictionary->words[$word]);
                } else {
                    foreach($config->dictionary->index[$lang][$word] as $word) {
                        $listing[$word] = WordView::entryToDtString($config, $request, $config->dictionary->words[$word]);
                    }
                }
            }
            ksort($listing);

            $page->content .= '<dl class="dictionaryList">'.implode($listing)."</dl>";
        } else {
            // Otherwise, say nothing was found.
            $page->content .= $config->getTrans('no matches found');
        }
    }

}
