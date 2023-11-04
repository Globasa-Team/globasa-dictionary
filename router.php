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

    // log_weird_error($request);


    try {
        switch ($request->controller) {
    
            case 'tul':
                $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
                ToolController::run($config, $request, $page);
                break;
    
            case 'lexi':
                WordController::output_entry($config, $request, $page);
                break;
    
            case 'cel-ruke':
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
    } catch (Error404Exception $e) {
        ErrorController::error_404($config, $request, $page);
    }
}


/**
 * Logs details about what's happening if the request is a string rather than an array.
 * Not sure why this happens periodically.
 */
function log_weird_error():void {
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
}