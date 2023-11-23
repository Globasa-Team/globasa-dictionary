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

    public static function results(WorldlangDictConfig $config, $matches, $lang, $request, $page)
    {
        // Show matches
        if (sizeof($matches)) {
            
            foreach ($matches as $word) {
                $word = strtolower($word);
                if ($lang=='glb') {
                    if (!file_exists($config->api2Path."terms/{$word}.yaml")) {
                        continue;
                    }
                    $entry = yaml_parse_file($config->api2Path."terms/{$word}.yaml");
                    $listing[$word] = WordView::entry_to_dt_string($config, $request, $entry);
                } else {
                    foreach($config->dictionary->index[$lang][$word] as $word) {
                        if (!file_exists($config->api2Path."terms/{$word}.yaml")) {
                            continue;
                        }
                        $entry = yaml_parse_file($config->api2Path."terms/{$word}.yaml");
                        $listing[$word] = WordView::entry_to_dt_string($config, $request, $entry);
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
