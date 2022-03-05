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
                // if ($currentPrefix == "he") {
                //     var_dump($currentPrefix.'3');
                // }
                $genWord = substr($currentPrefix, 0, -1).$currentRoot;
                $genList[$genWord][$currentRoot] = "$currentPrefix-|$currentRoot|";

                // Check if they were joined on the same letter, and check with only one
                // Eg., bur- and rito make burrito, check burito. Remove hyphen.
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

    public static function transAideBulkTranslate($config, $request) {
        $text = isset($_REQUEST['text']) ? $_REQUEST['text'] : null;
        $result = [];
        
        // Old code that broke text apart by line return
        // if (!empty($words)) {
            //     $words = preg_split("@[\s+　]@u", trim($text));
        // }
        
        // Break text up by sentence.
        
        if (!empty($text)) {
            $sentences = preg_split('/(?<=[.?!"\'])\s+(?=[a-z])/i', $text);
            
            foreach($sentences as $key=>$sentence) {
                $sentenceResult = new \stdClass();
                $sentenceResult->sentence = $sentence;
                $sentence = strtolower($sentence);

                // Remove punctuation using PCRE unicode character class for all punctuation characters
                $sentence = preg_replace('/\p{P}/', '', $sentence);
                // Split on whitepace
                $sentenceResult->words = preg_split("@[\s+　]@u", trim($sentence));
    
                $result[] = $sentenceResult;
            }

        }

        return $result;
        
    }


}
