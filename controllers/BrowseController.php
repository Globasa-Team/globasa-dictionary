<?php
namespace WorldlangDict;

class BrowseController
{
    public static function default(object $config, object $request, object &$page)
    {
        $page->setTitle("Globasa translation dictionary");
        $dict = yaml_parse_file($config->basic_location.$request->lang.".yaml");
        BrowseView::default(config:$config, lang:$request->lang, request:$request, page:$page, dict:$dict);
        include_once($config->templatePath.'view-browse.php');
    }


}
