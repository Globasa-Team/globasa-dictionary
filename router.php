<?php
namespace WorldlangDict;

/**
 * Calls the appropriate function based on the url.
 */
function router($config)
{
    $page = new Page($config->getTrans('App Name'));

    $request = new Request($config);

    if ($request->incomplete) {
        WorldlangDictUtils::redirect($config, "");
    }
    $config->setLang($request->lang);

    /*
    if (is_string($request)) {
        @error_log("\n-----".date(DATE_ATOM)."\n", 3, "debug.log");
        @error_log("\nrouter has a request as string.\n", 3, "debug.log");
        @error_log("\nrequest:\n".serialize($request)."\n", 3, "debug.log");
        @error_log("\nbacktrace:\n".serialize(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))."\n", 3, "debug.log");

        foreach(debug_backtrace() as $trace) {
                
            @error_log("\nfile :".$trace['file']."\n", 3, "debug.log");
            @error_log("\nfile :".$trace['class'].$trace['type'].$trace['function'].$trace['line']."\n", 3, "debug.log");
        }
    }
    */



    switch ($request->controller) {

        case 'tul':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            ToolController::run($config, $request, $page);
            break;

        case 'lexi':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            $word = isset($request->arguments[0]) ? $request->arguments[0] : null;
            WordController::addEntry($config, $request, $word, $page);
            include_once($config->templatePath.'view-default.php');
            break;

        case 'cel-ruke':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            WordController::addNatWord($config, $request, $config->lang, $page);
            include_once($config->templatePath.'view-default.php');
            break;

        case 'xerca':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            SearchController::search($config, $request, $page);
            include_once($config->templatePath.'view-default.php');
            break;

        case 'am-reporte':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            FeedbackController::feedback($config, $request, $page);
            include_once($config->templatePath.'view-default.php');
            break;

        case 'lexilari':
            WordController::addTags($config, $request, $page);
            break;
        case 'abeceli-menalari':
            BrowseController::default($config, $request, $page);
            include_once($config->templatePath.'view-browse.php');
            break;
        case 'test':
            $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
            TestController::helloWorld($config, $request, $page);
            include_once($config->templatePath.'view-default.php');
            break;
        default:
            IndexController::home($config, $request, $page);
            include_once($config->templatePath.'view-default.php');
            break;
    }
}
