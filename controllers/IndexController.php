<?php
namespace WorldlangDict;

class IndexController
{
    public static function home($config)
    {
        $result = '';
        $result .= WordController::randomWord($config);
        return $result;
    }
}
