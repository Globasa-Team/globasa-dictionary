<?php
namespace WorldlangDict;

class WordController {
    
    public static function getWord($config, $listLang, $term=null)
    {
        $list = new WordList($config, $listLang);
        if (is_null($term)) {
            $config->setPageTitle('Word list');
            return WordController::randomWord($config);
        } else {
            if (isset($config->dictionary['glb'][$term])) {
                $word = new Word($config, $config->dictionary['glb'][$term]);
                $config->setPageTitle($term.' definition');
                return $word->get($word);
            }
        }
    }
    
    public static function randomWord($config) {
        $result = '<strong>Random word</strong>';
        $wordIndex = array_rand($config->dictionary['glb']);
        $word = new Word($config, $config->dictionary['glb'][$wordIndex]);
        $result .= $word->get();
        return $result;
    }
}