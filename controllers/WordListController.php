<?php
namespace WorldlangDict;

class WordListController
{
    public static function getWordList($config, $listLang) {
        $list = new WordList($config, $listLang);
        $config->setPageTitle('Word list');
        return $list->get();
    }
    
}
