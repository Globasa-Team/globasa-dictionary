<?php
namespace WorldlangDict;

class ToolController
{
    public static function run($config, $request, &$page)
    {
        switch ($request->arguments[0]) {
            case 'homonym-check':
                ToolController::homonymCheck($config, $request, $page);
                break;
            case 'minimal-pair-detector':
                ToolController::minimalPairCheck($config, $request, $page);
                break;
            case 'candidate-check':
                ToolController::checkCandidateWord($config, $request, $page);
                break;
            default:
                ToolView::toolList($config, $page);
                break;
        }
        $page->setTitle($config->getTrans('tools button'));
    }

    public static function minimalPairCheck($config, $request, &$page)
    {
        $nearMatches = Tool::minimalPairCheck($config, $request);
        ToolView::minimalPairCheckTitle($config, $page);
        ToolView::minimalPairCheckInput($config, $page);
        ToolView::minimalPairCheck($config, $request, $nearMatches, $page);
        $page->setTitle($config->getTrans('minimum pair title'));
    }

    public static function homonymCheck($config, $request, &$page)
    {
        $genWords = Tool::homonymCheck($config, $request);
        ToolView::homonymCheckTitle($config, $page);
        ToolView::homonymCheckInput($config, $page);
        ToolView::homonymCheck($config, $request, $genWords, $page);
        $page->setTitle($config->getTrans('homonym terminator title'));
    }

    public static function checkCandidateWord($config, $request, &$page)
    {
        ToolView::minimalPairCheckTitle($config, $page);
        $nearMatches = Tool::minimalPairCheck($config, $request);
        ToolView::minimalPairCheck($config, $request, $nearMatches, $page);

        ToolView::homonymCheckTitle($config, $page);
        $genWords = Tool::homonymCheck($config, $request);
        ToolView::homonymCheck($config, $request, $genWords, $page);

        $page->setTitle($config->getTrans('candidate check title'));
    }
}
