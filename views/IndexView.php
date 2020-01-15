<?php
namespace WorldlangDict;

class IndexView
{
    public static function home(&$page)
    {
        $page->content = '<strong>Welcome to the Globasa translation dictionary.</strong>'.
            '<h1>Random Word</h1>'.
            $randomWord;
    }
}
