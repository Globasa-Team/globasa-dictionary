<?php
namespace WorldlangDict;

/* Source files */
include_once 'router.php';
include_once 'resources/downloadFile.php';
include_once 'resources/loadCsv.php';
include_once 'resources/Parsedown.php';
include_once 'WorldlangDictUtils.php';
include_once 'models/WorldlangDictConfig.php';
include_once 'models/Word.php';
include_once 'models/Request.php';
include_once 'models/Page.php';
include_once 'models/Tool.php';
include_once 'views/IndexView.php';
include_once 'views/SearchView.php';
include_once 'views/ToolView.php';
include_once 'views/WordView.php';
include_once 'views/FeedbackView.php';
include_once 'views/BrowseView.php';
include_once 'controllers/ToolController.php';
include_once 'controllers/WordController.php';
include_once 'controllers/SearchController.php';
include_once 'controllers/IndexController.php';
include_once 'controllers/UpdateController.php';
include_once 'controllers/FeedbackController.php';
include_once 'controllers/BrowseController.php';
include_once 'controllers/TestController.php';

$config = new WorldlangDictConfig();
include_once 'config.php';
