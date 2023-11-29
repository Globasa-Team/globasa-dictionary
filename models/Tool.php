<?php
namespace WorldlangDict;

class Tool
{

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
        
        // “” ‘’
        // '/(?<=[.?!"\'])\s+(?=[a-z])/i'
        // /(?<=[.?!"\'])\s+(?=[a-zA-Z0-9])/
        if (!empty($text)) {
            //$sentences = preg_split('/(?<=[.?!"\'])\s+(?=[a-zA-Z0-9"\'])/i', $text);
            $sentences = preg_split('/(?<=[.?!"\'”’‽])\s+(?=[a-zA-Z0-9"\'“‘])/i', $text);
            
            foreach($sentences as $key=>$sentence) {
                $sentenceResult = new \stdClass();
                $sentenceResult->sentence = $sentence;
                $sentence = strtolower($sentence);

                // Remove punctuation using PCRE unicode character class for all punctuation characters
                $sentence = preg_replace('/\p{P}/', '', $sentence);
                $sentence = preg_replace('/[“”‘’]/', '', $sentence);
                
                // Split on whitepace
                $sentenceResult->words = preg_split("@[\s+　]@u", trim($sentence));
    
                $result[] = $sentenceResult;
            }

        }

        return $result;
        
    }


}
