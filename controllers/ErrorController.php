<?php
namespace WorldlangDict;

class ErrorController
{
    public static function error_404 (object $config, object $request, object $page):void {
        include_once($config->templatePath.'404.php');
    }

}