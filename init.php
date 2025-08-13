<?php
// declare(strict_types=1);
namespace WorldlangDict;
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_regex_encoding('UTF-8');

/* Source files */
require_once('router.php');
require_once('resources/downloadFile.php');
require_once('resources/loadCsv.php');
require_once('resources/custom_exceptions.php');
require_once('WorldlangDictUtils.php');
require_once('models/WorldlangDictConfig.php');
require_once('models/Request.php');
require_once('models/Page.php');
require_once('models/Tool.php');
require_once('models/Homonym.php');
require_once('models/Minimal_pair.php');
require_once('models/Translation_aid.php');
require_once('controllers/Word_controller.php');
require_once('controllers/Search_controller.php');
require_once('controllers/Feedback_controller.php');
require_once('controllers/Browse_controller.php');
require_once('controllers/Dev_controller.php');
require_once('controllers/Error_controller.php');
require_once('controllers/Homonym_controller.php');
require_once('controllers/Minimal_pair_controller.php');
require_once('controllers/Candidate_word_controller.php');
require_once('controllers/Translation_aide_controller.php');
require_once('controllers/Welcome_controller.php');
require_once('controllers/Tags_controller.php');
require_once('controllers/Tool_controller.php');


/* Throw exception on error */
set_error_handler(function ($level, $message, $file = '', $line = 0) {
    throw new \ErrorException($message, 0, $level, $file, $line);
});

/* Handle exceptions */
set_exception_handler(function ($e) {
    error_log($e);
    http_response_code(500);
    if (ini_get('display_errors')) {
        echo(
            '<pre style="text-wrap: wrap; background-color: salmon;">'.
            nl2br($e) .
            '</pre></body></html>'
        );
    } else {
        include_once('views/error_wtf_view.php');
    }
});


$config = new WorldlangDictConfig();
require_once('config.php');
// Debug mode
if ($config->debugging) {
    $config->debugging = true;
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}
router($config);
