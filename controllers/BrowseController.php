<?php
namespace WorldlangDict;

class BrowseController
{
    public static function default($config, $request, &$page)
    {
        $page->setTitle("Globasa translation dictionary");
        BrowseView::default($config, $request->lang, $request, $page);
    }


}
