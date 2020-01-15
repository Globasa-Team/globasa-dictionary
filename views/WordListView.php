<?php
namespace WorldlangDict;

class WordListView
{
    public function addList($config, $request, $list, &$page)
    {
        foreach ($list->list as $wordIndex=>$entry) {
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($list->listLang != "glb") {
                    $page->content .= '<h1>'.sprintf($config->getTrans('Entry for'), $wordIndex, $list->lang).'</h1>';
                }
                WordView::DictionaryEntry($config, $request, $entry, $page);
            } else {
                if ($list->listLang != $config->worldlang) {
                    $page->content .= '<h1>'.sprintf($config->getTrans('Entries for'), $wordIndex, $list->lang).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $page->content .= $subEntry->getReverse();
                }
            }
        }
    }
}
