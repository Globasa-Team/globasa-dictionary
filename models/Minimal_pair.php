<?php
declare(strict_types=1);
namespace WorldlangDict;

class Minimal_pair
{

    public static function analyze($config, $request, array &$dict)
    {
        $words = array_keys($dict);
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

}