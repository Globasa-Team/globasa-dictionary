<?php
namespace WorldlangDict;

class WordListController
{
    // public static function getWordList($app, $listLang) {
    //     $list = new WordList($app, $listLang);
    //     $app->setPageTitle('Word list');
    //     return $list->get();
    // }
    
    public static function getWord($config, $listLang, $word=null)
    {
        $list = new WordList($config, $listLang);
        if (is_null($word)) {
            $config->setPageTitle('Word list');
            return WordController::randomWord($config);
        } else {
            $config->setPageTitle($word.' definition');
            return $list->get($word);
        }
    }
}
