<?php

declare(strict_types=1);

namespace WorldlangDict;

class Homonym_controller
{
    public static function check($config, $request, &$page)
    {
        $dict = yaml_parse_file($config->basic_location . $request->lang . '.yaml');
        $homonyms = Homonym::analyze($request, $dict);
        $page->setTitle($config->getTrans('homonym terminator title'));
        $page->description = $config->getTrans('homonym terminator description');
        $page->show_input = true;
        include('views/homonym_view.php');
    }
}
