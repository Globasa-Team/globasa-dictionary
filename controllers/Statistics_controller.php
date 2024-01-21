<?php

namespace WorldlangDict;


class Statistics_controller
{
    public static function default($config, $request, &$page)
    {
        $page->setTitle('Estatisti');
        $page->description = "estatisti";
        $stats = yaml_parse_file($config->stats_location);
        include_once('views/statistics_view.php');
    }
}