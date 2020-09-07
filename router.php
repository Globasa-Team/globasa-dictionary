<?php
namespace WorldlangDict;

/**
 * Calls the appropriate function based on the url.
 */
function router($config)
{
    $page = new Page($config->siteName);

    $request = new Request($config);

    if ($request->incomplete) {
        WorldlangDictUtils::redirect($config, "");
    }
    $config->setLang($request->lang);

    switch ($request->controller) {

        case 'tule':
            ToolController::run($config, $request, $page);
            break;

        case 'leksi':
            $word = isset($request->arguments[0]) ? $request->arguments[0] : null;
            WordController::addEntry($config, $request, $word, $page);
            break;

        case 'cel-ruke':
            WordController::addNatWord($config, $request, $config->lang, $page);
            break;

        case 'search':
            SearchController::search($config, $request, $page);
            break;

        case 'leksilar':
            // WordListController::getWordList($config, $request, $config->worldlang, $page);
            // WordController::addWordList($config, $request, $config->worldlang, $page);
            WordController::addTags($config, $request, $page);
            break;

        default:
            IndexController::home($config, $request, $page);
            break;
    }
    include_once($config->templatePath.'index.php');
}
