<?php
namespace WorldlangDict;

class WordListController
{
    public static function getWordList($config, $listLang, &$page) {
        $list = new WordList($config, $listLang);
        $page->setPageTitle('Word list');
        WordListView::addList($page);
    }
    
}
