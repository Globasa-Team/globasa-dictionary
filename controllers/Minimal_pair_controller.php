<?php
declare(strict_types=1);
namespace WorldlangDict;

class Minimal_pair_controller
{

    public static function check($config, $request, &$page)
    {
        $dict = yaml_parse_file($config->min_location."eng.yaml");
        $pairs = Minimal_pair::analyze($config, $request, $dict);
        $page->setTitle($config->getTrans('minimum pair title'));
        $page->description = $config->getTrans('minimum pair description');
        $page->show_input = true;
        include('views/minimal_pair_view.php');
    }

}