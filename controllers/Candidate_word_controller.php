<?php
namespace WorldlangDict;

class Candidate_word_controller
{
    public static function check($config, $request, &$page)
    {
        $dict = yaml_parse_file($config->basic_location.$request->lang.'.yaml');
        $homonyms = Homonym::analyze($config, $request, $dict);
        $pairs = Minimal_pair::analyze($config, $request, $dict);
        
        $page->setTitle($config->getTrans('candidate check title'));
        $page->description = $config->getTrans('candidate check description');
        $page->show_input = false;
        include('views/candidate_word_view.php');
    }
}