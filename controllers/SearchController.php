<?php
namespace WorldlangDict;

class SearchController
{
    /**
     * If exact match is found, redirect. Otherwise show partial matches.
     */
    public static function search(object $config, object $request, string &$page)
    {

        if (empty($request->options)) {
            WorldlangDictUtils::redirect($config, $request);
        } elseif (isset($request->option['glb'])) {
            globasa_term_search($config, $lang, $term, $page);
        } else {
            $term = $request->option[0];
            $lang = array_key_first();
            natlang_term_search($config, $lang, $term, $page);
        }


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

    private static function globasa_term_search(object $config, string $term, string &$page) {
        $terms = yaml_parse_file($config->search_terms_location."glb.yaml");
        $index = yaml_parse_file($config->index_location);
    }

    private static function natlang_term_search(object $config, string $lang, string $term) {

    }

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