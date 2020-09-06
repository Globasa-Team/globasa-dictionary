<?php
namespace WorldlangDict;

class Tool
{
    public static function homonymCheck($config, $request)
    {

        // Add the new root candidate
        if (isset($request->options['candidate']) && !empty($request->options['candidate'])) {
            $root[] = $newRoot = $request->options['candidate'];
            $genList[$newRoot]['New:'.$newRoot] = "New:$newRoot";
        }

        // Create arrays for 3 category types, put all roots in genList.
        foreach ($config->dictionary->words as $word=>$entry) {
            if ($entry->category=='root') {
                $root[]=$word;
                $genList[$word]["|$word|"] = "|$word|";
            } elseif ($entry->category=='affix' && $word[0]=='-') {
                $suffix[]= $word;
            } elseif ($entry->category=='affix') {
                $prefix[] = $word;
            }
        }

        // Generate all combinations, duplicate if combos on duplicate letter
        foreach ($root as $currentRoot) {
            foreach ($prefix as $currentPrefix) {
                $genWord = substr($currentPrefix, 0, -1).$currentRoot;
                $genList[$genWord][$currentRoot] = "$currentPrefix-|$currentRoot|";

                if (substr($currentPrefix, -2, 1) == $currentRoot[0]) {
                    $genWord = substr($currentPrefix, 0, -2) . $currentRoot;
                    $genList[$genWord][$currentRoot] = "$currentPrefix-|$currentRoot|";
                }
            }
            foreach ($suffix as $currentSuffix) {
                $genWord = $currentRoot.substr($currentSuffix, 1);
                $genList[$genWord][$currentRoot] = "|$currentRoot|-$currentSuffix";

                if (substr($currentRoot, -1) == $currentSuffix[1]) {
                    $genWord = $currentRoot.substr($currentSuffix, 2);
                    $genList[$genWord][$currentRoot] = "|$currentRoot|-$currentSuffix";
                }
            }
        }
        ksort($genList);

        return $genList;
    }

    public static function minimalPairCheck($config, $request)
    {
        $words = array_keys($config->dictionary->words);
        $numWords = sizeof($words);
        $nearMatches = [];
        $checkWord = isset($request->options['candidate']) ? strtolower($request->options['candidate']) : null;

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

    public static function candidateWordCheck($config, $request)
    {
        $words = array_keys($config->dictionary->words);
        $numWords = sizeof($words);
        $nearMatches = [];
        $checkWord = isset($request->options['word']) ? strtolower($request->options['word']) : null;


        return $nearMatches;
    }
}
