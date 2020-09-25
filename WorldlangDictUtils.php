<?php
namespace WorldlangDict;

class WorldlangDictUtils
{
    public static function makeUri($config, $controller, $request)
    {
        // var_dump($request);
        // if(empty($request)) throw new \Exception("makeUri");
        return $config->siteUri.$config->lang.'/'.$controller.$request->linkQuery;
    }

    public static function changeLangUri($config, $request, $lang)
    {
        if (is_null($request->arguments)) {
            $args = '';
        } elseif (sizeof($request->arguments) == 1) {
            $args = $request->arguments[0];
        } else {
            $args = implode('/', $request->arguments);
        }
        return $config->siteUri.$lang.'/'
            .$request->controller.'/'
            .$args
            .$request->linkQuery;
    }

    public static function redirect($config, $request, $controller="")
    {
        header('Location: '.WorldlangDictUtils::makeUri($config, $controller, $request));
        die();
    }

    public static function makeLink($config, $controller, $request, $text=null)
    {
        if ($text == null) {
            $text = $controller;
        }
        return '<a href="'. WorldlangDictUtils::makeUri($config, $controller, $request).'">'.$text.'</a>';
    }
}
