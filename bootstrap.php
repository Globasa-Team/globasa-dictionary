<?php
namespace WorldlangDict;

/* Source files */
include_once './router.php';
include_once './WorldlangDictUtils.php';
include_once './models/WorldlangDictConfig.php';
include_once './models/Word.php';
include_once './models/WordList.php';
include_once './models/Request.php';
include_once './models/Page.php';
include_once './models/Tool.php';
include_once './views/IndexView.php';
include_once './views/SearchView.php';
include_once './views/ToolView.php';
include_once './views/WordView.php';
include_once './views/WordListView.php';
include_once './controllers/ToolController.php';
include_once './controllers/WordListController.php';
include_once './controllers/WordController.php';
include_once './controllers/SearchController.php';
include_once './controllers/IndexController.php';

$config = new WorldlangDictConfig();
include_once './config.php';
