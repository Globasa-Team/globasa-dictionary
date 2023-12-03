<?php
namespace WorldlangDict;

class ToolController
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
                include_once($config->templatePath.'view-default.php');
                break;
            case 'ifa-trasharufitul':
                $page->setTitle($config->getTrans('ipa converter title'));
                $page->description = $config->getTrans('ipa converter description');
                include_once($config->templatePath.'view-ipa-converter.php');
                break;
            case 'estatisti':
                $page->setTitle('Estatisti');
                $page->description = "estatisti";
                $stats = yaml_parse_file($config->stats_location);
                include_once($config->templatePath.'view-statistics.php');
                break;
            default:
                $page->setTitle($config->getTrans('tools button'));
                ToolView::toolList($config, $page, $request);
                include_once($config->templatePath.'view-default.php');
                break;
            }
    }
}
