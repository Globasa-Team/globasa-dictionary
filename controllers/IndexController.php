<?php
namespace WorldlangDict;

class IndexController
{
    public static function home($config, $request, &$page)
    {
        IndexView::home($config, $page);
        WordController::randomWord($config, $request, $page);
        $page->setTitle("Globasa translation dictionary");
    }
}
