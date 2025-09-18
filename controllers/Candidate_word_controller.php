<?php

declare(strict_types=1);

namespace WorldlangDict;

class Candidate_word_controller
{
    public static function check(WorldlangDictConfig $config, Request $request, Page &$page)
    {
        $dict = yaml_parse_file($config->basic_location . $request->lang . '.yaml');
        $homonyms = Homonym::analyze($request, $dict);
        $pairs = Minimal_pair::analyze($request, $dict);

        $page->setTitle($config->getTrans('candidate check title'));
        $page->description = $config->getTrans('candidate check description');
        $page->show_input = false;
        include('views/candidate_word_view.php');
    }
}
