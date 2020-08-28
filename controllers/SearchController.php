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
        $page->setTitle($config->getTrans('search result title'));

        if (!is_null($request->options)) {
            if (isset($request->options['wterm']) && !empty($request->options['wterm'])) {
                $term = strtolower($request->options['wterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary->words, $config->worldlang, $term);
                $lang = 'glb';
            } elseif (isset($request->options['nterm']) && !empty($request->options['nterm'])) {
                $term = strtolower($request->options['nterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary->index[$request->lang], $request->lang, $term);
                $lang = 'natlang';
            } else {
                WorldlangDictUtils::redirect($config);
            }
        } else {
            WorldlangDictUtils::redirect($config);
        }

        SearchView::results($config, $partialMatches, $lang, $page);
    }

    private static function searchLang($config, $dict, $lang, $term)
    {
        // look for exact match
        if ($lang == 'glb') {
            if (isset($dict[$term])) {
                WorldlangDictUtils::redirect($config, 'leksi/'.urlencode($term));
            }
        } else {
            if (isset($dict[$term])) {
                WorldlangDictUtils::redirect($config, 'cel-ruke/'.urlencode($term));
            }
        }

        // look for partial match in user lang
        foreach ($dict as $word=>$data) {
            // insert, replace, delete
            if (levenshtein($term, $word, 1, 1, 1)<2) {
                $partialMatches[] = $word;
            }
        }
        return $partialMatches;
    }
}
