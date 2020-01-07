<?php
namespace WorldlangDict;

class SearchController
{
    
    public static function search($config, $request)
    {
        $result = "";
        $world = $config->dictionary['glb'];
        $nat = $config->dictionary[$request->lang];
        $term = strtolower($request->options['term']);
        // var_dump($request->options);
        $partialMatchesWorld = [];
        $partialMatchesNat = [];
        
        if (!is_null($request->options)) {
            if (isset($request->options['term'])) {
                
                if(isset($request->options['gsearch'])) {
                    $partialMatches .= SearchController::searchLang($config, $config->dictionary, 'glb', $term);
                }
                else if(isset($request->options['lsearch'])) {
                    $partialMatches .= SearchController::searchLang($config, $config->dictionary, $request->lang, $term);
                }
            } else {
                // redirect to main page
                WorldlangDictUtils::redirect($config);
            }
        } else {
            // redirect to main page
            WorldlangDictUtils::redirect($config);
        }
        
        return SearchView::results($partialMatches);
    }
    
    private static function searchLang($config, $dict, $lang, $term) {
                
        // look for exact match
        if (isset($dict[$lang][$term])) {
            if ($lang == 'glb') {
                WorldlangDictUtils::redirect($config, 'leksi/'.urlencode($term));
                
            }
            else {
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
        
        return $result;
    }
}
