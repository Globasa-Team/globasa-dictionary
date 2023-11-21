<?php
namespace WorldlangDict;

class IndexController
{
    public static function home($config, $request, &$page)
    {
        // WordController::randomWord($config, $request, $page);
        include_once($config->templatePath.'welcome.php');
    }
}
