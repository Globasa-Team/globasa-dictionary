<?php namespace WorldlangDict;

class BrowseView
{

    public static function default(object $config, string $lang, object $request, object $page, array $dict)
    {
        $listing = array();
        foreach ($dict as $term=>$data) {
            $listing[$term] = WordView::entry_to_dl_pair_string(config:$config, request:$request, term:$term, data:$data);
        }
        ksort($listing);

        $page->content .= '<dl class="dictionaryList browse">'.implode($listing)."</dl>";
    }

}