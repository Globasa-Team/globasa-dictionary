<?php
namespace WorldlangDict;

class Welcome_controller
{
    public static function home($config, $request, &$page)
    {
        include_once('views/welcome_view.php');
    }
}