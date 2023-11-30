<?php
namespace WorldlangDict;

class Minimal_pair_controller
{

    public static function check($config, $request, &$page)
    {
        $index = yaml_parse_file($config->index_location);
        $pairs = Minimal_pair::analyze($config, $request, $index);
        $page->setTitle($config->getTrans('minimum pair title'));
        $page->description = $config->getTrans('minimum pair description');
        $page->show_input = true;
        include('views/minimal_pair_view.php');
    }

}