<?php
namespace WorldlangDict;

class SearchController
{

    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     */
    public static function search(object $config, object $request, Page &$page)
    {
        $partial_matches = null;
        if (empty($request->options)) {
            WorldlangDictUtils::redirect($config, $request);
        } elseif (!empty($request->options['glb'])) {
            $lang = "glb";
            $partial_matches = self::globasa_term_search(config:$config, term:$request->options['glb'], page:$page, request:$request);
        } else {
            $lang = array_key_first($request->options);
            if (strcmp($lang, "glb")===0) {
                $lang = array_key_last($request->options);
            }
            $term = $request->options[$lang];
            $partial_matches = self::natlang_term_search($config, $lang, $term, $page);
        }
        SearchView::results($config, $partial_matches, $lang, $request, $page);
        include_once($config->templatePath.'view-default.php');

        return;

        die();

        if (!is_null($request->options)) {
            if (!empty($request->options['wterm'])) {
                // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
                $index = yaml_parse_file($config->index_location);
                $page->setTitle($config->getTrans('search result title').": ".$request->options['wterm']);
                $partialMatches = SearchController::searchLang($config, $request, $config->worldlang, $request->options['wterm']);
                $lang = 'glb';
            } elseif (!empty($request->options['nterm'])) {
                $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
                // $natlang_index = $config->search_terms_location.$request->lang.".yaml";
                $page->setTitle($config->getTrans('search result title').": ".$request->options['nterm']);
                $partialMatches = SearchController::searchLang($config, $request, $request->lang, $request->options['nterm']);
                $lang = $config->lang;
            } else {
                $page->setTitle($config->getTrans('search result title'));
                WorldlangDictUtils::redirect($config, $request);
            }
        } else {
            WorldlangDictUtils::redirect($config, $request);
        }

        // If not redirected, show term
        SearchView::results($config, $partialMatches, $lang, $request, $page);
        include_once($config->templatePath.'view-default.php');
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
    private static function globasa_term_search(object $config, string $term, object $request, Page &$page):array {
        // $terms = yaml_parse_file($config->search_terms_location."glb.yaml");
        $index = yaml_parse_file($config->index_location);

        if (array_key_exists($term, $index)) {
            if (empty($index[$term])) {
                WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($term));
            } elseif (is_string($index[$term])) {
                WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($index[$term]));
            }
        }
        return self::globasa_levenshtein_search($term, $index);
    }



    /**
     * Search natlang for term.
     */
    private static function natlang_term_search(object $config, string $lang, string $term, object $request):string {
        // check if file exists
        if (!file_exists($config->search_terms_location.$lang.".yaml")) {
            throw new Error404Exception("Entry Language Not Found");
        }
        $terms = yaml_parse_file($config->search_terms_location.$lang.".yaml");

        if (isset($terms[$term])) {
            if (count($terms[$term]) == 1) {
                WorldlangDictUtils::redirect($config, $request, 'lexi/'.urlencode($terms[$term][0]));
            } else {
                WorldlangDictUtils::redirect($config, $request, 'cel-ruke/'.urlencode($term));
            }
        }
        $partial_matches="";
        return $partial_matches;
    }


    /**
     * Deprecated DELETE!
     */
    private static function searchLang($config, $request, $lang, $term)
    {
        $index = $config->search_terms_location.$lang.".yaml";
        
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