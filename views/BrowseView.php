<?php namespace WorldlangDict;

class BrowseView
{

    public static function default($config, $lang, $request, $page)
    {
        // Show matches
        foreach ($config->dictionary->words as $entry) {
            $listing[$entry->term] = WordView::entryToDtString($config, $request, $entry);
        }
        ksort($listing);

        $page->content .= '<dl class="dictionaryList">'.implode($listing)."</dl>";
    }

}