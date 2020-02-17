<?php
namespace WorldlangDict;

class WordController
{
    public static function addEntry($config, $request, $term, &$page)
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
    
    public static function addNatWord($config, $request, $lang, &$page)
    {
        $term = isset($request->arguments[0]) ? $request->arguments[0] : null;
        
        if (is_null($term)) {
            WorldlangDictUtils::redirect($config, "");
        } else {
            if (isset($config->dictionary[$lang][$term])) {
                $matches = explode(", ", $config->dictionary[$lang][$term]);
                foreach ($matches as $curMatch) {
                    $word = new Word($config, $config->dictionary[$config->worldlang][$curMatch]);
                    WordView::dictionaryEntry($config, $request, $word, $page);
                }
                $page->setTitle($term.': '.$config->getTrans('natlang search title bar'));
            }
        }
    }
    
    public static function randomWord($config, &$page)
    {
        $wordIndex = array_rand($config->dictionary[$config->worldlang]);
        WordController::addEntry($config, $request, $wordIndex, $page);
        $page->setTitle("Random word");
    }
}
