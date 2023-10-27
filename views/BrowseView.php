<?php namespace WorldlangDict;

class BrowseView
{

    public static function default($config, $dict, $lang, $request, $page)
    {
        // Show matches
        foreach ($dict as $term=>$entry) {
            $listing[$term] = WordView::entryToDtString($config, $request, $entry);
        }
        ksort($listing);

        $page->content .= '<dl class="dictionaryList browse">'.implode($listing)."</dl>";
    }

}