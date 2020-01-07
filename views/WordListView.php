<?php
namespace WorldlangDict;

class WordListView {
    
    public function addList(&$page)
    {
        foreach ($this->list as $wordIndex=>$entry) {
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($this->listLang != "glb") {
                    $page->content .= '<h1>'.sprintf($this->app->getTrans('Entry for'), $wordIndex, $this->listLang).'</h1>';
                }
                $page->content .= $entry->get($word);
            } else {
                if ($this->listLang != "glb") {
                    $page->content .= '<h1>'.sprintf($this->app->getTrans('Entries for'), $wordIndex, $this->listLang).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $page->content .= $subEntry->getReverse();
                }
            }
        }
    }
}