<?php
namespace WorldlangDict;

class SearchController
{
    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     */
    public static function search($config, $request, &$page)
    {
        if (!is_null($request->options)) {
            if (!empty($request->options['wterm'])) {
                $page->setTitle($config->getTrans('search result title').": ".$request->options['wterm']);
                $partialMatches = SearchController::searchLang($config, $request, $config->dictionary->index['glb'], $config->worldlang, $request->options['wterm']);
                $lang = 'glb';
            } elseif (!empty($request->options['nterm'])) {
                $page->setTitle($config->getTrans('search result title').": ".$request->options['nterm']);
                $partialMatches = SearchController::searchLang($config, $request, $config->dictionary->index[$request->lang], $request->lang, $request->options['nterm']);
                $lang = $config->lang;
            } else {
                $page->setTitle($config->getTrans('search result title'));
                WorldlangDictUtils::redirect($config, $request);
            }
        } else {
            WorldlangDictUtils::redirect($config, $request);
        }
        SearchView::results($config, $partialMatches, $lang, $request, $page);
    }

    private static function searchLang($config, $request, $dict, $lang, $term)
    {
        $term = strtolower(trim($term));
        // first, try to look for exact match
        if ($lang == 'glb') {
            if (isset($dict[$term]) && isset($dict[$term][$term])) {
                WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($term));
            } elseif (isset($dict[$term])) {
                return $dict[$term];
            }
        } else {
            if (isset($dict[$term])) {
                WorldlangDictUtils::redirect($config, $request, 'cel-ruke/'.urlencode($term));
            }
        }

        // Finally look for a partial match in index
        $partialMatches = [];
        foreach ($dict as $word=>$data) {
            // insert, replace, delete
            if (levenshtein($term, $word, 1, 1, 1)<2) {
                if (count($data) == 1) {
                    $partialMatches[$word] = $word;
                }
                else {
                    foreach ($data as $cur) {
                        $i = ( ($lang == 'glb') ? $cur : $word);
                        $partialMatches[$i] = $i;
                    }
                }
            }
        }

        return $partialMatches;
    }
}
