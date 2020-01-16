<?php
namespace WorldlangDict;

class SearchController
{
    public static function search($config, $request, &$page)
    {
        $world = $config->dictionary[$config->worldlang];
        $nat = $config->dictionary[$request->lang];
        
        $partialMatchesWorld = [];
        $partialMatchesNat = [];
        var_dump($request);
        die("search");
        if (!is_null($request->options)) {
            if (isset($request->options['wterm']) && !empty($request->options['wterm'])) {
                $term = strtolower($request->options['wterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary, $config->worldlang, $term);
            } elseif (isset($request->options['nterm']) && !empty($request->options['nterm'])) {
                $term = strtolower($request->options['nterm']);
                $partialMatches = SearchController::searchLang($config, $config->dictionary, $request->lang, $term);
            } else {
                // redirect to main page
                WorldlangDictUtils::redirect($config);
            }
        } else {
            // redirect to main page
            WorldlangDictUtils::redirect($config);
        }
        
        SearchView::results($config, $partialMatches, $page);
    }
    
    private static function searchLang($config, $dict, $lang, $term)
    {
        // look for exact match
        if (isset($dict[$lang][$term])) {
            if ($lang == 'glb') {
                WorldlangDictUtils::redirect($config, 'leksi/'.urlencode($term));
            } else {
                WorldlangDictUtils::redirect($config, 'cel-ruke/'.urlencode($term));
            }
        }
        
        // look for partial match in user lang
        foreach ($dict[$lang] as $word=>$data) {
            // insert, replace, delete
            if (levenshtein($term, $word, 1, 1, 1)<2) {
                $partialMatches[] = $word;
            }
        }
        return $partialMatches;
    }
}
