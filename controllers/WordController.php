<?php
namespace WorldlangDict;

class WordController {
    
    public static function addEntry($config, $term, &$page)
    {
        if (is_null($term)) {
            WordController::randomWord($config, $page);
        } else {
            if (isset($config->dictionary[$config->worldlang][$term])) {
                $word = new Word($config, $config->dictionary[$config->worldlang][$term]);
                $page->setTitle($term);
                WordView::dictionaryEntry($config, $request, $word, $page);
            }
        }
    }
    
    public static function getNatWord($config, $lang, $term=null)
    {
        if (is_null($term)) {
            $config->setPageTitle('Word list');
            return WordController::randomWord($config);
        } else {
            $result = "";
            if (isset($config->dictionary[$lang][$term])) {
                $matches = explode(", ", $config->dictionary[$lang][$term]);
                foreach ($matches as $curMatch) {
                    $word = new Word($config, $config->dictionary[$config->worldlang][$curMatch]);
                    $result .= $word->get($word);
                }
                $config->setPageTitle($term.': English to Globasa');
                return $result;
            }
        }
    }
    
    public static function randomWord($config, &$page) {
        $wordIndex = array_rand($config->dictionary[$config->worldlang]);
        WordController::addEntry($config, $wordIndex, $page);
    }
}