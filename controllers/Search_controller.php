<?php
namespace WorldlangDict;

class Search_controller
{

    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     * $results is used by view
     */
    public static function search(object $config, object $request, Page &$page)
    {
        $results = null;
        $term = "";
        if (!empty($request->options[WL_CODE_SHORT])) {
            $lang = WL_CODE_SHORT;
            $term = trim($request->options[WL_CODE_SHORT]);
            $results = self::globasa_term_search(config:$config, query:$term, page:$page, request:$request);
        } else {
            $lang = array_key_first($request->options);
            if (strcmp($lang, WL_CODE_SHORT)===0) {
                $lang = array_key_last($request->options);
            }
            if (empty($request->options[$lang])) {
                WorldlangDictUtils::redirect($config, $request);
            }
            $term = trim($request->options[$lang]);
            $results = self::natlang_term_search($config, $lang, $term, $page);
        }
        $page->setTitle($config->getTrans('search result title').': '.$term);
        require_once('views/search_results_view.php');

        return;
    }



    /**
     * Do a partial match search through the Globasa index.
     */
    private static function globasa_levenshtein_search(string $term, array &$index) {
        // Finally look for a partial match in index
        $partialMatches = [];
        foreach ($index as $key=>$data) {
            if (levenshtein($term, $key, 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                }
                else {
                    $partialMatches[$data] = $data;
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search Globasa index for term.
     */
    private static function globasa_term_search(object $config, string $query, object $request, Page &$page):array {
        $terms = yaml_parse_file($config->search_terms_location.WL_CODE_SHORT.'.yaml');
        
        if (array_key_exists($query, $terms) && count($terms[$query])==1) {
            WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($terms[$query][0]));
        } else {
            if (array_key_exists($query, $terms)) {
                return $terms[$query];
            } else {
                $index = yaml_parse_file($config->index_location);
                return self::globasa_levenshtein_search($query, $index);
            }
        }
    }






    /**
     * Do a partial match search through the Globasa index.
     */
    private static function natlang_levenshtein_search(string $term, string $lang, array &$terms) {
        // Finally look for a partial match in index
        
        // Convert term to ASCII for `levenshtein()`.
        // Turns multibyte accent characters to ?
        $term = mb_convert_encoding($term, "ASCII");
        
        $partialMatches = [];
        foreach ($terms as $key=>$data) {
            if (levenshtein($term, mb_convert_encoding($key, "ASCII"), 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                }
                else {
                    foreach($data as $hit) {
                        $partialMatches[$key] = $hit;
                        // TODO: Is this overwritting some results?
                    }
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search natlang for term.
     */
    private static function natlang_term_search(object $config, string $lang, string $term, object $request):array {
        // check if file exists
        if (!file_exists($config->search_terms_location.$lang.".yaml")) {
            throw new Error_404_Exception("Search Language Not Found");
        }
        $terms = yaml_parse_file($config->search_terms_location.$lang.".yaml");

        if (isset($terms[$term])) {
            if (count($terms[$term]) == 1) {
                WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($terms[$term][0]));
            } else {
                WorldlangDictUtils::redirect($config, $request, 'cel-ruke/'.urlencode($term));
            }
        }
        return self::natlang_levenshtein_search(term:$term, lang:$lang, terms:$terms);
    }

}