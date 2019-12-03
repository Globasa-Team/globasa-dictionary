<?php
namespace WorldlangDict;

class WordListController
{
    // public static function getWordList($app, $listLang) {
    //     $list = new WordList($app, $listLang);
    //     $app->setPageTitle('Word list');
    //     return $list->get();
    // }
    
    public static function getWord($app, $listLang, $word=null) {
        $list = new WordList($app, $listLang);
        if (is_null($word)) {
            $app->setPageTitle('Word list');
        }
        else {
            $app->setPageTitle($word.' definition');
        }
        return $list->get($word);
        
    }
}