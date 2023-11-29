<?php
namespace WorldlangDict;

class Homonym_controller
{
    public static function check($config, $request, &$page)
    {
        // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $dict = yaml_parse_file($config->basic_location."eng.yaml");
        $nearMatches = Homonym::analyze($config, $request, $dict);
        $page->setTitle($config->getTrans('homonym terminator title'));
        $page->description = $config->getTrans('homonym terminator description');
        include('views/homonym_view.php');
    }
    
}
