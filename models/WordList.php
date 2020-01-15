<?php
namespace WorldlangDict;

class WordList
{
    public $listLang;
    public $list;
    
    public function __construct($config, $lang='glb')
    {
        $this->listLang = $lang;
        
        foreach ($config->dictionary[$lang] as $word=>$wordData) {
            if ($lang == $config->worldlang) {
                $this->list[strtolower($word)] = new Word($config, $wordData);
            } else {
                $wLWords = explode(',', $wordData);
                if (sizeof($wLWords)==1) {
                    $this->list[$word] = new Word($config, $config->dictionary[$config->worldlang][$wLWords[0]]);
                } else {
                    foreach ($wLWords as $wLWord) {
                        $this->list[$word][$glbWord] = new Word($config, $config->dictionary[$config->worldlang][trim($wLWord)]);
                    }
                }
            }
        }
    }
}
