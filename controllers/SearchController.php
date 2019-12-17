<?php
namespace WorldlangDict;

class SearchController
{
    
    // public function __construct(&$app, $option)
    // {
        
    // }
    public static function search($config, $request)
    {
        $result = "";
        $glb = $config->dictionary['glb'];
        $lang = $config->dictionary[$request->lang];
        $term = strtolower($request->options['term']);
        // var_dump($request->options);
        $partialMatchesGlb = [];
        $partialMatchesLang = [];
        
        if (!is_null($request->options)) {
            if (isset($request->options['term'])) {
                
                if(isset($request->options['gsearch'])) {
                    $result .= SearchController::searchLang($config, $config->dictionary, 'glb', $term);
                }
                else if(isset($request->options['lsearch'])) {
                    $result .= SearchController::searchLang($config, $config->dictionary, $request->lang, $term);
                }
                // // look for exact match in Globasa
                // // look for exact match in $lang
                // $glbMatch = isset($glb[$term]);
                // $langMatch = isset($lang[$term]);
                // // if found, send to one or the other. If both, ask.
                // if ($glbMatch && !$langMatch) {
                //     WorldlangDictUtils::redirect($config, 'leksi/'.urlencode($term));
                // } elseif (!$glbMatch && $langMatch) {
                //     WorldlangDictUtils::redirect($config, 'cel-ruke/'.urlencode($term));
                // } elseif ($glbMatch && $langMatch) {
                //     $fullMatches = $term.', '.$langMatch;
                // }
                
                // // look for partial match in Globasa
                // foreach ($glb as $word=>$data) {
                //     // insert, replace, delete
                //     if (levenshtein($word, $term, 1, 1, 1)<2) {
                //         $partialMatchesGlb[] = $word;
                //     }
                // }
                // // look for partial match in user lang
                // foreach ($lang as $word=>$data) {
                //     // insert, replace, delete
                //     if (levenshtein($term, $word, 1, 1, 1)<2) {
                //         $partialMatchesLang[] = $word;
                //     }
                // }
                
                // // if found, Ask what they want.
                // if (sizeof($partialMatchesGlb) || $glbMatch) {
                //     $result .= '<h3 style="color: black">Globasa language results</h3><ul>';
                    
                //     if ($glbMatch) {
                //         $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'leksi/'.urlencode($term), $word) . ' Exact Match<br/>'.$glb[$word]['Definition'.$config->langCap].'</li>';
                //     }
                //     foreach ($partialMatchesGlb as $word) {
                //         $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'leksi/'.urlencode($word), $word).'<br/>'.$glb[$word]['Definition'.$config->langCap].'</li>';
                //     }
                //     $result .= '</ul>';
                // }
                // if (sizeof($partialMatchesGlb) || sizeof($partialMatchesLang) || $glbMatch || $langMatch) {
                //     $result .= '<h3 style="color: black">Lang/English language results</h3><ul>';
                    
                //     if ($langMatch) {
                //         $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'cel-ruke/'.urlencode($term), $word) . ' Exact Match'.'<br/>'.$glb[$lang[$word]]['Definition'.$config->langCap].'</li>';
                //     }
                //     foreach ($partialMatchesLang as $word) {
                //         $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'cel-ruke/'.urlencode($word), $word).'<br/>'.$glb[$lang[$word]]['Definition'.$config->langCap].'</li>';
                //     }
                //     $result .= '</ul>';
                // } else {
                //     // Otherwise, say nothing was found.
                //     $result .= 'No matches found!';
                // }
            } else {
                // redirect to main page
                WorldlangDictUtils::redirect($config);
            }
        } else {
            // redirect to main page
            WorldlangDictUtils::redirect($config);
        }
        
        return $result;
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
        
        // if found, Ask what they want.
        $result .= '<h3 style="color: black">Search results</h3>';
        if (sizeof($partialMatches)) {
            $result .= '<ul>';
            
            foreach ($partialMatches as $word) {
                if ($lang=='glb') {
                    $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'leksi/'.urlencode($word), $word).'<br/>'.$dict[$lang][$word]['Definition'.$config->langCap].'</li>';
                }
                else {
                    if (strpos($dict[$lang][$word], ',') === false) {
                        $def = $dict['glb'][$dict[$lang][$word]]['Definition'.$config->langCap];
                    }
                    else {
                        $def = $dict[$lang][$word];
                    }
                    $result .= '<li>'.WorldlangDictUtils::makeLink($config, 'cel-ruke/'.urlencode($word), $word).'<br/>'.$def.'</li>';
                    
                }
            }
            $result .= '</ul>';
        } else {
            // Otherwise, say nothing was found.
            $result .= 'No matches found!';
        }
        
        return $result;
    }
}
