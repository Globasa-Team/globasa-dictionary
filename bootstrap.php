<?php
namespace WorldlangDict;

/* Source files */
require_once 'router.php';
require_once 'resources/downloadFile.php';
require_once 'resources/loadCsv.php';
require_once 'resources/Parsedown.php';
require_once 'resources/404_exception.php';
require_once 'WorldlangDictUtils.php';
require_once 'models/WorldlangDictConfig.php';
require_once 'models/Request.php';
require_once 'models/Page.php';
require_once 'models/Tool.php';
require_once 'models/Homonym.php';
require_once 'models/Minimal_pair.php';
require_once 'models/Translation_aid.php';
require_once 'controllers/WordController.php';
require_once 'controllers/SearchController.php';
require_once 'controllers/FeedbackController.php';
require_once 'controllers/BrowseController.php';
require_once 'controllers/TestController.php';
require_once 'controllers/ErrorController.php';
require_once 'controllers/Homonym_controller.php';
require_once 'controllers/Minimal_pair_controller.php';
require_once 'controllers/Candidate_word_controller.php';
require_once 'controllers/Translation_aide_controller.php';
require_once 'controllers/Index_controller.php';
require_once 'controllers/Tags_controller.php';
require_once 'controllers/ToolController.php';

$config = new WorldlangDictConfig();
require_once 'config.php';
