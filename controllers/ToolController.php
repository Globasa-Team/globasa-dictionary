<?php
namespace WorldlangDict;

class ToolController
{
    public static function run($config, $request, &$page)
    {
        switch ($request->arguments[0]) {
            case 'homonym-terminator':
                ToolController::homonymTerminator($config, $request, $page);
                break;
            case 'minimal-pair-detector':
                ToolController::minimalPairDetector($config, $request, $page);
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

    public static function minimalPairDetector($config, $request, &$page)
    {
        $nearMatches = Tool::minimalPairDetector($config, $request);
        ToolView::minimalPairDetector($config, $request, $nearMatches, $page);
        $page->setTitle($config->getTrans('minimum pair title'));
    }

    public static function homonymTerminator($config, $request, &$page)
    {
        $genWords = Tool::homonymTerminator($config, $request);
        ToolView::homonymTerminator($config, $request, $genWords, $page);
        $page->setTitle($config->getTrans('homonym terminator title'));
    }

    public static function checkCandidateWord($config, $request, &$page)
    {
        // $genWords = Tool::checkCandidateWord($config, $request);
        ToolController::homonymTerminator($config, $request, $page);
        ToolController::minimalPairDetector($config, $request, $page);
        // ToolView::checkCandidateWord($config, $request, $genWords, $page);
        $page->setTitle($config->getTrans('candidate check title'));
    }
}
