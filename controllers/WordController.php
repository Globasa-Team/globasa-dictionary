<?php
namespace WorldlangDict;

class WordController
{
    public static function addEntry($config, $request, $term, &$page)
    {
        //die("WordController/AddEntry doesn't need to create the word!");
        //echo "test";
        if (is_null($term)) {
            WordController::randomWord($config, $page);
        } else {
            if (isset($config->dictionary->words[$term])) {
                //$word = new Word($config, $config->dictionary->words[$term]);
                $word = $config->dictionary->words[$term];
                $page->setTitle($term);

                WordView::dictionaryEntry($config, $request, $word, $page);
            }
            //var_dump($page->content);
            //die("WordController/AddEntry doesn't need to create the word!");
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

    public static function getWordList($config, $request, $listLang, &$page)
    {
        $list = [];
        if ($listLang == $config->worldlang) {
            // NOTE Should this be in the Word class?
            foreach ($config->dictionary->words as $word=>$wordData) {
                $list[strtolower($word)] = new Word($config, $wordData);
            }
        } else {
            // NOTE Should this be in the Word class?
            foreach ($config->dictionary->index as $word=>$wordData) {
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

        $page->setTitle($config->getTrans('all words button'));
        WordListView::addList($config, $request, $list, $page);
    }

    public static function randomWord($config, &$page)
    {
        $wordIndex = array_rand($config->dictionary->words);
        WordController::addEntry($config, $request, $wordIndex, $page);
        $page->setTitle("Random word");
    }
}
