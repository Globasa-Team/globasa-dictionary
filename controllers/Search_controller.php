<?php

declare(strict_types=1);

namespace WorldlangDict;

class Search_controller
{

    /**
     * Do a partial match search through the natlang index.
     */
    private static function natlang_levenshtein_search(string $term, string $lang, array &$terms) {
        // Finally look for a partial match in index
        
        // Convert term to ASCII for `levenshtein()`.
        // Turns multibyte accent characters to ?
        $term = mb_convert_encoding($term, "ASCII");
        
        $partialMatches = [];
        foreach ($terms as $key=>$data) {
            /*
                PHP seems to take `$a['7']=''` and store the index as a number.
                `yaml_emit` and `yaml_parse` definately interprets it that way.
                So I don't think this can be fixed by switch to JSON.
                So if the numeral '7' is used as a translation it will cause
                `mb_convert_encoding()` to fail because it expects a string.
            */
            if (is_int($key)) $key = strval($key);
            if (levenshtein($term, mb_convert_encoding($key, "ASCII"), 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                }
                else {
                    foreach($data as $hit) {
                        $partialMatches[] = $hit;
                    }
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search natlang for term.
     */
    private static function natlang_term_search(object $config, string $lang, string $term, Request $request):array {
        // check if file exists
        if (!file_exists($config->search_terms_location.$lang.".yaml")) {
            throw new Error_404_Exception("Search Language Not Found");
        }
        $terms = yaml_parse_file($config->search_terms_location.$lang.".yaml");

        if (isset($terms[$term])) {
            if (count($terms[$term]) == 1) {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$term][0]));
            } else {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'natlang-search', arg:urlencode($term));
            }
        }
        return self::natlang_levenshtein_search(term:$term, lang:$lang, terms:$terms);
    }



    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     * $results is used by view
     */
    public static function search(object $config, object $request, Page &$page)
    {
        if (!empty($request->options[WL_CODE_SHORT])) {
            // worldlang search
            $term = mb_trim($request->options[WL_CODE_SHORT], encoding:"UTF-8");
            $results = self::worldlang_term_search(config:$config, query:$term, page:$page, request:$request);
        } else {
            // natlang search
            if (empty($request->options[$config->lang])) {
                WorldlangDictUtils::redirect(config:$config, request:$request);
            }
            $term = mb_trim($request->options[$config->lang], encoding:"UTF-8");
            $results = self::natlang_term_search(config:$config, lang:$config->lang, term:$term, request:$request);
        }
        $match = array_search($term, $results, true);
        if ($match !== false) {
            $data = $results[$match];
            unset($results[$match]);
            array_unshift($results, $data);
        }
        $page->setTitle($config->getTrans('search result title').': '.$term);
        $page->description = implode(", ", $results); // TODO: Use IntlListFormatter in PHP 8.5
        require_once('views/search_results_view.php');

        return;
    }



    /**
     * Do a partial match search through the Globasa index.
     */
    private static function worldlang_levenshtein_search(string $term, array &$index):array {
        // Finally look for a partial match in index
        $partialMatches = [];
        foreach ($index as $key=>$data) {
            if (levenshtein($term, $key, 1, 1, 1)<2) {
                if (empty($data)) {
                    $partialMatches[$key] = $key;
                } else {
                    foreach($data as $match_slug) {
                        $partialMatches[$match_slug] = $match_slug;
                    }
                }
            }
        }

        return $partialMatches;
    }



    /**
     * Search worldlang index for term.
     * 
     * If key exists in index:
     * - if only one entry, redirect to that entry.
     * - if search term has exact match, redirect to that entry.
     * - if multiple matches, return array.
     * 
     * Else, return results of near matches.
     */
    private static function worldlang_term_search(object $config, string $query, object $request, Page &$page):array {
        $terms = yaml_parse_file($config->search_terms_location.WL_CODE_SHORT.'.yaml');
        
        if (array_key_exists($query, $terms)) {
            if (count($terms[$query])==1) {
                WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$query][0]));
            }
            // elseif (($key = array_search($query, $terms[$query])) !== false) {
            //     WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:urlencode($terms[$query][$key]));
            // }
            else {
                return $terms[$query];
            }
            return $terms[$query];

        } else {
            return self::worldlang_levenshtein_search($query, $terms);
        }
    }

}