<?php
namespace WorldlangDict;

class Minimal_pair_controller
{

    public static function check($config, $request, &$page)
    {
        // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $index = yaml_parse_file($config->index_location);
        $nearMatches = Minimal_pair::analyze($config, $request, $index);
        $page->setTitle($config->getTrans('minimum pair title'));
        $page->description = $config->getTrans('minimum pair description');
        include('views/minimal_pair_view.php');
    }

}