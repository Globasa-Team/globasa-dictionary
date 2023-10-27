<?php
namespace WorldlangDict;

class WordController
{
    public static function addEntry($config, $request, $term, &$page)
    {
        if (!empty($term)) {
            if (isset($config->dictionary->words[$term])) {
                $word = $config->dictionary->words[$term];
                $page->setTitle($word->term);

                WordView::dictionaryEntry($config, $request, $word, $page);
            }
        } else {
            WordController::randomWord($config, $request, $page);
        }
    }

    public static function addNatWord($config, $request, $lang, &$page)
    {
        $term = isset($request->arguments[0]) ? $request->arguments[0] : null;

        if (is_null($term)) {
            WorldlangDictUtils::redirect($config, $redirect, "");
        } else {
            if (isset($config->dictionary->index[$lang][$term])) {
                // foreach ($config->dictionary->index[$lang][$term] as $curMatch) {
                //     WordView::dictionaryEntry(
                //         $config,
                //         $request,
                //         $config->dictionary->words[$curMatch],
                //         $page
                //     );
                // }
                SearchView::results($config, $config->dictionary->index[$lang][$term], 'glb', $request, $page);
                $page->setTitle($term.': '.$config->getTrans('natlang search title bar'));
            }
        }
    }

    public static function addTags($config, $request, &$page)
    {
        $tags = yaml_parse_file($config->tag_location);
        $defs = yaml_parse_file($config->min_location . "{$config->lang}.yaml");
    
        if (isset($request->arguments[0]) && isset($tags[$request->arguments[0]])) {
            $tag = $request->arguments[0];
            $page->setTitle($tag . ' &mdash; ' . $config->getTrans('tags title'));
            include_once($config->templatePath.'view-tags-tag-words.php');
        } else {
            $page->setTitle($config->getTrans('tags title'));
            include_once($config->templatePath.'view-tags-list-tags.php');
        }

    }

    public static function addWordList($config, $request, $listLang, &$page)
    {
        // $list = new WordList($config, $listLang);
        $page->setTitle($config->getTrans('all words button'));
        WordView::addList($config, $request, $page);
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

    public static function randomWord($config, $request, &$page)
    {
        $wordIndex = array_rand($config->dictionary->words);
        WorldlangDictUtils::redirect($config, $request, "lexi/".$wordIndex);
        // WordController::addEntry($config, $request, $wordIndex, $page);
        // $page->setTitle("Random word");
    }
}
