<?php
namespace WorldlangDict;

class IndexController
{
    public static function home($config, &$page)
    {
        IndexView::home($page);
        WordController::randomWord($config, $page);
    }
}
