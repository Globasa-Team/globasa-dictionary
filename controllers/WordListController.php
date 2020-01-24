<?php
namespace WorldlangDict;

class WordListController
{
    public static function getWordList($config, $request, $listLang, &$page)
    {
        $list = new WordList($config, $listLang);
        $page->setTitle($config->getTrans('all words button'));
        WordListView::addList($config, $request, $list, $page);
    }
}
