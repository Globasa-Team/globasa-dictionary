<?php
namespace WorldlangDict;

class WordController {
    
    public static function getWord($config, $term=null)
    {
        if (is_null($term)) {
            $config->setPageTitle('Word list');
            return WordController::randomWord($config);
        } else {
            if (isset($config->dictionary['glb'][$term])) {
                $word = new Word($config, $config->dictionary['glb'][$term]);
                $config->setPageTitle($term);
                return $word->get($word);
            }
        }
    }
    
    public static function getReverseWord($config, $lang, $term=null)
    {
        if (is_null($term)) {
            $config->setPageTitle('Word list');
            return WordController::randomWord($config);
        } else {
            if (isset($config->dictionary[$lang][$term])) {
                $word = new Word($config, $config->dictionary['glb'][$config->dictionary[$lang][$term]]);
                $config->setPageTitle($term.': English to Globasa');
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