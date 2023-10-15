<?php
namespace WorldlangDict;

class ToolController
{
    public static function run($config, $request, &$page)
    {
        $arg = isset($request->arguments[0]) ? $request->arguments[0] : '';
        switch ($arg) {
            case 'samaeskri-lexi':
                ToolController::homonymCheck($config, $request, $page);
                include_once($config->templatePath.'view-default.php');
                break;
            case 'minimum-duaxey':
                ToolController::minimalPairCheck($config, $request, $page);
                include_once($config->templatePath.'view-default.php');
                break;
            case 'kandidato-lexi':
                ToolController::checkCandidateWord($config, $request, $page);
                include_once($config->templatePath.'view-default.php');
                break;
            case 'basatayti':
                ToolController::transAide($config, $request, $page);
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
                $stats = yaml_parse_file($config->statsFile);
                include_once($config->templatePath.'view-statistics.php');
            default:
                $page->setTitle($config->getTrans('tools button'));
                ToolView::toolList($config, $page, $request);
                include_once($config->templatePath.'view-default.php');
                break;
            }
    }
    
    public static function minimalPairCheck($config, $request, &$page)
    {
        $nearMatches = Tool::minimalPairCheck($config, $request);
        ToolView::minimalPairCheckTitle($config, $page);
        ToolView::minimalPairCheckInput($config, $request, $page);
        ToolView::minimalPairCheck($config, $request, $nearMatches, $page);
        $page->setTitle($config->getTrans('minimum pair title'));
        $page->description = $config->getTrans('minimum pair description');
    }
    
    public static function homonymCheck($config, $request, &$page)
    {
        $genWords = Tool::homonymCheck($config, $request);
        ToolView::homonymCheckTitle($config, $page);
        ToolView::homonymCheckInput($config, $request, $page);
        ToolView::homonymCheck($config, $request, $genWords, $page);
        $page->setTitle($config->getTrans('homonym terminator title'));
        $page->description = $config->getTrans('homonym terminator description');
    }
    
    public static function checkCandidateWord($config, $request, &$page)
    {
        ToolView::homonymCheckTitle($config, $page);
        $genWords = Tool::homonymCheck($config, $request);
        ToolView::homonymCheck($config, $request, $genWords, $page);
        
        ToolView::minimalPairCheckTitle($config, $page);
        $nearMatches = Tool::minimalPairCheck($config, $request);
        ToolView::minimalPairCheck($config, $request, $nearMatches, $page);
        
        $page->setTitle($config->getTrans('candidate check title'));
        $page->description = $config->getTrans('candidate check description');
    }
    
    public static function transAide($config, $request, &$page)
    {
        $bulkWords = Tool::transAideBulkTranslate($config, $request);

        ToolView::transAideTitle($config, $page, $request);
        ToolView::transAideInput($config, $request, $page);
        ToolView::transAideResults($config, $request, $bulkWords, $page);
        
        $page->setTitle($config->getTrans('translation aide title'));
        $page->description = $config->getTrans('translation aide description');
    }
    
}
