<?php
namespace WorldlangDict;

class Test_controller
{
    public static function helloWorld($config, $request, &$page)
    {
        $page->setTitle("dict test");
        $page->content = "Hello, world!";
        include_once('views/dev_dashboard_view.php');
    }
}
