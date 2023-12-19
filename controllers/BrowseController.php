<?php
namespace WorldlangDict;

class BrowseController
{
    public static function default(object $config, object $request, object &$page)
    {
        $page->setTitle("Globasa translation dictionary");
        $dict = yaml_parse_file($config->basic_location.$request->lang.".yaml");
        require_once('views/browse_view.php');
    }


}
