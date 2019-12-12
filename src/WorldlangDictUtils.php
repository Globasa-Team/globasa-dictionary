<?php
namespace WorldlangDict;

class WorldlangDictUtils
{
    public static function makeUri ($config, $controller) {
        return $config->siteUri.$config->lang.'/'.$controller;
    }
    
    public static function redirect ($config, $controller="") {
        header('Location: '.WorldlangDictUtils::makeUri($config, $controller));
        die();
    }
    
    public static function makeLink ($config, $controller, $text=null) {
        if ($text == null) {
            $text = $controller;
        }
        return '<a href="'. WorldlangDictUtils::makeUri($config, $controller).$request->linkQuery.'">'.$text.'</a>';
    }
}