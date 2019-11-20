<?php
namespace GlobasaDictionary;

class WordListController
{
    public static function getWordList($app, $listLang) {
        $list = new WordList($app, $listLang);
        $app->setPageTitle('Word list');
        return $list->get();
    }
    
    public static function getWord($app, $listLang, $word) {
        $list = new WordList($app, $listLang);
        $app->setPageTitle($word.' definition');
        return $list->get($word);
        
    }
}