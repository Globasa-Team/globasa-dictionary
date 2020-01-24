<?php
namespace WorldlangDict;

class IndexView
{
    public static function home($config, &$page)
    {
        $page->content = '<strong>Welcome to the Globasa translation dictionary.</strong>'.
            '<h1>'.$config->getTrans('random word button').'</h1>'.
            $randomWord;
    }
}
