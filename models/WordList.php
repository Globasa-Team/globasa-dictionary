<?php
namespace WorldlangDict;

class WordList {
    private $app, $listLang, $list;
    
    function __construct ($app, $lang='glb') {
        $this->app = $app;
        $this->listLang = $lang;
        //load dictionary
        foreach($this->app->dictionary[$lang] as $word=>$wordData) {
            if ($lang == 'glb')
            {
                $this->list[$word] = new Word($app, $wordData);
            }
            else
            {
                $glbWords = explode(',', $wordData);
                if (sizeof($glbWords)==1)
                {
                    $this->list[$word] = new Word($app, $this->app->dictionary['glb'][$glbWords[0]]);
                }
                else
                {
                    foreach ($glbWords as $glbWord)
                    {
                        $this->list[$word][$glbWord] = new Word($app, $this->app->dictionary['glb'][trim($glbWord)]);
                    }
                }
            }
        }
    }
    
    public function get($word = null) {
        $result = '<div id="exactMatch"></div>';
        
        foreach($this->list as $wordIndex=>$entry) {
            // var_dump($entry->get());
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($this->listLang != "glb") {
                    $result .='<h1>'.sprintf($this->app->getTrans('Entry for'),$wordIndex,$this->listLang).'</h1>';
                }
                $result .= $entry->get($word);
            }
            else {
                if ($this->listLang != "glb") {
                    $result .='<h1>'.sprintf($this->app->getTrans('Entries for'),$wordIndex,$this->listLang).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $result .= $subEntry->getReverse();
                }
            }
        }
        return $result;
    }
}