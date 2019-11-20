<?php
namespace GlobasaDictionary;

/* Source files */
include_once './src/App.php';
include_once './src/request.php';
include_once './models/Word.php';
include_once './models/WordList.php';
include_once './controllers/ToolController.php';
include_once './controllers/WordListController.php';

/* App config */
$app = new GlobasaApp();
/* Site configurations (change these) */
$app->siteUri = 'http://demo.partialsolution.ca/globasa-dictionary/';
$app->siteName = 'Globasa Dictionary';
$app->template = 'photon';
$app->lang = $app->defaultLang = "glb";
$app->langCap = $app->defaultLangCap = "Glb";
$app->auxLang = "eng";
$app->auxLangCap = "Eng";

/* App configurations (leave these alone) */
$app->templatesFolder = 'templates';
$app->templatePath = "./".$app->templatesFolder.'/'.$app->template.'/';
$app->templateUri = $app->siteUri.$app->templatesFolder.'/'.$app->template.'/';

$app->dictionaryFile = './data/dictionary.yaml';
$app->languagesFile = './data/languages.yaml';
$app->internationalizationFile = './data/internationalization.yaml';

$app->dictionary = yaml_parse_file($app->dictionaryFile);
$app->languages = yaml_parse_file($app->languagesFile);
$app->trans = yaml_parse_file($app->internationalizationFile);