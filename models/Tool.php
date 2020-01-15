<?php
namespace WorldlangDict;

class Tool {
    
    public static function homonymTerminator($config, $request) {
    
        // Create arrays for 3 category types
        foreach ($config->dictionary[$config->worldlang] as $word=>$entry) {
            if ($entry['Category']=='root') {
                $root[]=$word;
                $genList[$word][] = 'Root from word list';
            } elseif ($entry['Category']=='affix' && $word[0]=='-') {
                $suffix[]= $word;
            } elseif ($entry['Category']=='affix') {
                $prefix[] = $word;
            }
        }
        
        // Add the new root
        if (isset($request->options['root']) && !empty($request->options['root'])) {
            $root[] = $request->options['root'];
        }
        
        // $page->content.= '<p>Found '.sizeof($root).' root, '.sizeof($prefix).' prefixes and '.sizeof($suffix).' suffixes</p>';
        
        // Generate all word combinations
        foreach ($root as $currentRoot) {
            foreach ($suffix as $currentSuffix) {
                $genWord = $currentRoot.substr($currentSuffix, 1);
                $genList[$genWord][] = "$currentRoot-$currentSuffix";
            }
            foreach ($prefix as $currentPrefix) {
                $genWord = substr($currentPrefix, 0, -1).$currentRoot;
                $genList[$genWord][] = "$currentPrefix-$currentRoot";
            }
        }
        ksort($genList);
        
        return $genList;
        // Show results for each word.
        
        foreach ($genList as $genWord=>$genRoots) {
            if (sizeof($genRoots)>1) {
                if (isset($config->dictionary['glb'][$genWord])) {
                    $definition = '</br>'.$config->dictionary['glb'][$genWord][DefinitionEng];
                } else {
                    $definition = "";
                }
                $page->content .= '<li><span style="font-weight: bold; font-size: larger;">'.$genWord."</span><br />".
                    "conflicting roots: ". implode($genRoots, ', ').$definition."</li>";
            }
        }
    }
    
    public static function minimalPairDetector ($config, $request) {
        $words = array_keys($config->dictionary[$config->worldlang]);
        $numWords = sizeof($words);
        $nearMatches = [];
        $checkWord = isset($request->options['word']) ? strtolower($request->options['word']) : null;
        
        if (empty($checkWord)) {
            for ($i = 0; $i < $numWords; $i++) {
                for ($j = $i+1; $j < $numWords; $j++) {
                    $distance = levenshtein($words[$i], $words[$j]);
                    if ($distance <= 2) {
                        $nearMatches[$words[$i]][$words[$j]] = $distance;
                    }
                }
            }
        } else {
            for ($i = 0; $i < $numWords; $i++) {
                $distance = levenshtein($checkWord, $words[$i]);
                if ($distance <= 2) {
                    $nearMatches[$checkWord][$words[$i]] = $distance;
                }
            }
        }
        
        return $nearMatches;
    }
}