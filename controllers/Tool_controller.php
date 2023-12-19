<?php
namespace WorldlangDict;

class Tool_controller
{
    public static function run($config, $request, &$page)
    {
        $arg = isset($request->arguments[0]) ? $request->arguments[0] : '';
        switch ($arg) {
            case 'samaeskri-lexi':
                Homonym_controller::check($config, $request, $page);
                break;
            case 'minimum-duaxey':
                Minimal_pair_controller::check($config, $request, $page);
                break;
            case 'kandidato-lexi':
                Candidate_word_controller::check($config, $request, $page);
                break;
            case 'basatayti':
                Translation_aid_controller::default($config, $request, $page);
                break;
            case 'ifa-trasharufitul':
                $page->setTitle($config->getTrans('ipa converter title'));
                $page->description = $config->getTrans('ipa converter description');
                include_once('views/ipa_converter_view.php');
                break;
            case 'estatisti':
                $page->setTitle('Estatisti');
                $page->description = "estatisti";
                $stats = yaml_parse_file($config->stats_location);
                include_once('views/view_statistics.php');
                break;
            default:
                $page->setTitle($config->getTrans('tools button'));
                include_once('views/features_view.php');
                break;
        }
    }
}
