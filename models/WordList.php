<?php
namespace WorldlangDict;

class WordList
{
    private $app;
    private $listLang;
    private $list;
    
    public function __construct($app, $lang='glb')
    {
        $this->app = $app;
        $this->listLang = $lang;
        //load dictionary
        foreach ($this->app->dictionary[$lang] as $word=>$wordData) {
            if ($lang == 'glb') {
                $this->list[strtolower($word)] = new Word($app, $wordData);
            } else {
                $glbWords = explode(',', $wordData);
                if (sizeof($glbWords)==1) {
                    $this->list[$word] = new Word($app, $this->app->dictionary['glb'][$glbWords[0]]);
                } else {
                    foreach ($glbWords as $glbWord) {
                        $this->list[$word][$glbWord] = new Word($app, $this->app->dictionary['glb'][trim($glbWord)]);
                    }
                }
            }
        }
    }
    
    
    public function getNew($word = null)
    {
        $result = '';
        if ($this->listLang == 'glb') {
            $result .= $this->list[$word]->get();
        } else {
            if ($this->listLang != "glb") {
                $result .='<strong>'.sprintf($this->app->getTrans('Entries for'), $word, $this->listLang).'</strong>';
            }
            if (is_a($this->list[$word], 'WorldlangDict\Word')) {
                // Single word
                $result .= $this->list[$word]->getReverse();
            } else {
                // Array
                foreach ($this->list[$word] as $subEntry) {
                    // $result .= "Something /$word/";
                    $result .= $subEntry->getReverse();
                }
            }
        }
        return $result;
    }
    
    public function get($word = null)
    {
        $result = '<div id="exactMatch"></div>';
        
        foreach ($this->list as $wordIndex=>$entry) {
            // var_dump($entry->get());
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($this->listLang != "glb") {
                    $result .='<h1>'.sprintf($this->app->getTrans('Entry for'), $wordIndex, $this->listLang).'</h1>';
                }
                $result .= $entry->get($word);
            } else {
                if ($this->listLang != "glb") {
                    $result .='<h1>'.sprintf($this->app->getTrans('Entries for'), $wordIndex, $this->listLang).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $result .= $subEntry->getReverse();
                }
            }
        }
        return $result;
    }
}
