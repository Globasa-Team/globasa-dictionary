<?php
namespace WorldlangDict;

class TestController
{
    public static function helloWorld($config, $request, &$page)
    {
        // IndexView::home($config, $page);
        // WordController::randomWord($config, $request, $page);
        $page->setTitle("Globasa translation dictionary");
        $page->content = "Hello, world!";
        
    }
}
