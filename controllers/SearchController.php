<?php
namespace WorldlangDict;

class SearchController
{
    public static function search($config, $request, &$page)
    {
        $world = $config->dictionary->words;
        $nat = $config->dictionary->index[$request->lang];

        $partialMatchesWorld = [];
        $partialMatchesNat = [];
        $page->setTitle($config->getTrans('search result title').": ".$request->options['wterm']." ".$request->options['nterm']);

        if (!is_null($request->options)) {
            if (!empty($request->options['wterm'])) {
                $term = strtolower($request->options['wterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary->index[glb], $config->worldlang, $term);
                $lang = 'glb';
            } elseif (!empty($request->options['nterm'])) {
                $term = strtolower($request->options['nterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary->index[$request->lang], $request->lang, $term);
                $lang = 'natlang';
            } else {
                WorldlangDictUtils::redirect($config);
            }
        } else {
            WorldlangDictUtils::redirect($config);
        }
        SearchView::results($config, $partialMatches, $lang, $request, $page);
    }

    private static function searchLang($config, $dict, $lang, $term)
    {
        // look for exact match
        if ($lang == 'glb') {
            if (isset($dict[$term]) && isset($dict[$term][$term])) {
                WorldlangDictUtils::redirect($config, 'leksi/'.urlencode($term));
            } elseif (isset($dict[$term])) {
                return $dict[$term];
            }
        } else {
            if (isset($dict[$term])) {
                WorldlangDictUtils::redirect($config, 'cel-ruke/'.urlencode($term));
            }
        }

        // look for partial match in index
        foreach ($dict as $word=>$data) {
            // insert, replace, delete
            if (levenshtein($term, $word, 1, 1, 1)<2) {
                $partialMatches[] = $word;
            }
        }
        var_dump($partialMatches);

        return $partialMatches;
    }
}
