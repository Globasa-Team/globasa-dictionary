<?php
namespace WorldlangDict;

class Homonym
{

    public static function analyze($config, $request, &$dict)
    {

        // Add the new root candidate
        if (isset($request->options['candidate']) && !empty($request->options['candidate'])) {
            $root[] = $newRoot = $request->options['candidate'];
            $genList[$newRoot]['New:'.$newRoot]['root'] = "New:$newRoot";
        }

        // Create arrays for 3 category types, put all roots in genList.
        foreach ($dict as $word=>$entry) {
            if ($entry['category']=='root') {
                $root[]=$word;
                $genList[$word]["|$word|"]['root'] = "$word";
            } elseif ($entry['category']=='affix' && $word[0]=='-') {
                $suffix[]= $word;
            } elseif ($entry['category']=='affix') {
                $prefix[] = $word;
            }
        }

        // Generate all combinations, duplicate if combos on duplicate letter
        foreach ($root as $currentRoot) {
            foreach ($prefix as $currentPrefix) {
                $genWord = substr($currentPrefix, 0, -1).$currentRoot;
                $genList[$genWord][$currentRoot]['pre'] = $currentPrefix;
                $genList[$genWord][$currentRoot]['root'] = $currentRoot;

                // Check if they were joined on the same letter, and check with only one
                // Eg., bur- and rito make burrito, check burito. Remove hyphen.
                if (substr($currentPrefix, -2, 1) == $currentRoot[0]) {
                    $genWord = substr($currentPrefix, 0, -2) . $currentRoot;
                    $genList[$genWord][$currentRoot]['pre'] = $currentPrefix;
                    $genList[$genWord][$currentRoot]['root'] = $currentRoot;
                }
            }
            foreach ($suffix as $currentSuffix) {
                $genWord = $currentRoot.substr($currentSuffix, 1);
                $genList[$genWord][$currentRoot]['root'] = $currentRoot;
                $genList[$genWord][$currentRoot]['suf'] = $currentSuffix;

                if (substr($currentRoot, -1) == $currentSuffix[1]) {
                    $genWord = $currentRoot.substr($currentSuffix, 2);
                    $genList[$genWord][$currentRoot]['root'] = $currentRoot;
                    $genList[$genWord][$currentRoot]['suf'] = $currentSuffix;
                }
            }
        }
        ksort($genList);

        return $genList;
    }

}