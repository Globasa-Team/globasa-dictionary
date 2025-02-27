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
            case 'tools':
            case 'tul': // Globasa
                Tool_controller::run($config, $request, $page);
                break;
            case 'words':
            case 'lexi': // Globasa
                Word_controller::output_entry($config, $request, $page);
                break;
            case 'natlang-search':
            case 'cel-ruke': // Globasa
                Word_controller::addNatWord($config, $request, $config->lang, $page);
                break;
            case 'search':
            case 'xerca': // Globasa
                Search_controller::search($config, $request, $page);
                break;
            case 'feedback':
            case 'am-reporte': // Globasa
                Feedback_controller::feedback($config, $request, $page);
                break;
            case 'tags':
            case 'lexilari': // Globasa
                Tags_controller::addTags($config, $request, $page);
                break;
            case 'browse':
            case 'abeceli-menalari': // Globasa
                Browse_controller::default($config, $request, $page);
                break;
            case 'natlangs':
            case 'estatisti-fe-lexiasel': // Globasa
                require_once('controllers/Natlangs_controller.php');
                Natlangs_controller::run($config, $request, $page);
                break;
            case 'natlang-browse':
            case 'natlang-abeceli': // Globasa
                require_once('controllers/Natlang_browse_controller.php');
                Natlang_browse_controller::default($config, $request, $page);
                break;
            case 'stats':
            case 'estatisti': // Globasa
                require_once('controllers/Statistics_controller.php');
                Statistics_controller::default($config, $request, $page);
                break;
            case 'reports':
                require_once('controllers/Reports_controller.php');
                Reports_controller::run($config, $request, $page);
                break;
            case 'test':
                Test_controller::helloWorld($config, $request, $page);
                break;
            case '':
                Welcome_controller::home($config, $request, $page);
                break;
            default:
                throw new Error_404_Exception("Invalid controller");
        }
    } catch (Error_404_Exception $e) {
        Error_controller::error_404($config, $request, $page);
    } catch (Error_loading_data_exception $e) {
        Error_controller::data_error($config, $request, $page);
    } catch (Error_invalid_request_exception $e) {
        Error_controller::invalid_request($config, $request, $page);
    } catch(\Throwable $t) {
        if ($config->debugging) {
            Error_controller::debug($config, $request, $page, $t);
        }
        Error_controller::wtf($config, $request, $page);
    }
}


/**
 * Logs details about what's happening if the request is a string rather than an array.
 * Not sure why this happens periodically.
 */
function log_weird_error($request):void {
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