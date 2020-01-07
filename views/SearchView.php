<?php
namespace WorldlandDict;

class SearchView {
    public static function results ($matches) {
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
    }
}