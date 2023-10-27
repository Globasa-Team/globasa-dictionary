<?php
namespace WorldlangDict;

class BrowseController
{
    public static function default($config, $request, &$page)
    {
        // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $dict = yaml_parse_file($config->api2Path . "min_{$config->lang}.yaml");
        $page->setTitle("Globasa translation dictionary");
        BrowseView::default($config, $request->lang, $request, $page);
    }


}
