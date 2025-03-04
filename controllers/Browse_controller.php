<?php
namespace WorldlangDict;

class Browse_controller
{
    public static function default(object $config, object $request, object &$page)
    {
        $page->setTitle("Translation dictionary");
        $dict = yaml_parse_file($config->basic_location.$request->lang.".yaml");
        require_once('views/browse_view.php');
    }


}
