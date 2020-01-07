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
            
        case 'leksi':
            $word = isset($request->arguments[0]) ? $request->arguments[0] : null;
            WordController::addEntry($config, $word, $page);
            break;
            
        case 'tule':
            ToolController::run($config, $request, $page);
            break;
            
        case 'cel-ruke':
            $page->content .= WordController::getNatWord($config, $config->lang, $config->option);
            break;
        
        case 'search':
            $page->content .= SearchController::search($config, $request);
            break;
            
        case 'leksilar':
            $page->content .= WordListController::getWordList($config, $config->worldlang, $config->option);
            break;
            
        default:
            IndexController::home($config, $page);
            break;
    }
    include_once($config->templatePath.'index.php');
}
