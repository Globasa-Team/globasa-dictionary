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
                ToolController::run($config, $request, $page);
                break;
            case 'lexi':
                WordController::output_entry($config, $request, $page);
                break;
            case 'cel-ruke':
                WordController::addNatWord($config, $request, $config->lang, $page);
                break;
            case 'xerca':
                SearchController::search($config, $request, $page);
                break;
            case 'am-reporte':
                FeedbackController::feedback($config, $request, $page);
                break;
            case 'lexilari':
                Tags_controller::addTags($config, $request, $page);
                break;
            case 'abeceli-menalari':
                BrowseController::default($config, $request, $page);
                break;
            case 'test':
                TestController::helloWorld($config, $request, $page);
                break;
            case '':
                Welcome_controller::home($config, $request, $page);
                break;
            default:
                throw new Error404Exception("Invalid controller");
        }
    } catch (Error404Exception $e) {
        Error_controller::error_404($config, $request, $page);
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