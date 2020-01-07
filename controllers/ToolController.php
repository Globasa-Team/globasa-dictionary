<?php
namespace WorldlangDict;

class ToolController
{
    
    public static function run($config, $request, &$page)
    {
        switch ($request->arguments[0]) {
            case 'homonym-terminator':
                ToolController::homonymTerminator($config, $request->argument[1], $page);
                break;
            case 'minimal-pair-detector':
                ToolController::minimalPairDetector($config, $argument, $page);
                break;
            default:
                ToolView::toolList($config, $page);
                break;
        }
    }
    
    public static function minimalPairDetector($config, $checkWord = null, &$page)
    {
        $page->content = '';
        $page->content .= "<h1>Find minimal pairings</h1>";
        $page->content .= '
            <form action='.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').' method="get">
                <input type="text" placeholder="Enter new word" />
                <input type="submit" value="Find pairs" />
            </form>
        ';
        $words = array_keys($config->dictionary['glb']);
        
        $numWords = sizeof($words);
        
        if (empty($checkWord)) {
            for ($i = 0; $i < $numWords; $i++) {
                for ($j = $i+1; $j < $numWords; $j++) {
                    $distance = levenshtein($words[$i], $words[$j]);
                    // var_dump($app->dictionary['glb'][$i]);
                    if ($distance == 2) {
                        $d2 .= '<li>'.$distance.": ".$words[$i].' with '. $words[$j].'</li>';
                    }
                    if ($distance == 1) {
                        $d1 .= '<li>'.$distance.": ".$words[$i].' with '. $words[$j].'</li>';
                    }
                }
            }
        } else {
            for ($i = 0; $i < $numWords; $i++) {
                $distance = levenshtein($checkWord, $words[$i]);
                // var_dump($app->dictionary['glb'][$i]);
                if ($distance == 2) {
                    $d2 .= '<li>'.$distance.' with '. $words[$i].'</li>';
                }
                if ($distance == 1) {
                    $d1 .= '<li>'.$distance.' with '. $words[$i].'</li>';
                }
            }
        }
        $page->content .="<h2>Pairs with a difference of 1:</h2>
                    <ul>".$d1."</ul>
                    <h2>Pairs with a difference of 2:</h2>
                    <ul>".$d2."</ul>";
    }
    
    public static function homonymTerminator($config, $newRoot = null, &$page)
    {
        $page->content .= "<h1>Find Homonyns</h1>";
        $page->content .= '<form action="/globasa-dictionary/eng/tool/homonym-terminator" method="post"><input placeholder="New root" /><input type="submit" /></form>';
        // var_dump($_REQUEST);
        // var_dump($_SERVER);
        foreach ($config->dictionary['glb'] as $word=>$entry) {
            if ($entry['Category']=='root') {
                $root[]=$word;
                $genList[$word][] = 'From word list';
            } elseif ($entry['Category']=='affix' && $word[0]=='-') {
                $suffix[]= $word;
            } elseif ($entry['Category']=='affix') {
                $prefix[] = $word;
            }
        }
        
        if (!empty($newRoot)) {
            $root = [$newRoot];
        }
        
        $page->content.= '<p>Found '.sizeof($root).' root, '.sizeof($prefix).' prefixes and '.sizeof($suffix).' suffixes</p>';
        foreach ($root as $currentRoot) {
            // echo "<h1>".$currentRoot."</h1>";
            foreach ($suffix as $currentSuffix) {
                $genWord = $currentRoot.substr($currentSuffix, 1);
                // echo " ".$genWord;
                // if (isset($app->dictionary['glb'][$genWord])) echo "!";
                $genList[$genWord][] = "$currentRoot-$currentSuffix";
            }
            foreach ($prefix as $currentPrefix) {
                $genWord = substr($currentPrefix, 0, -1).$currentRoot;
                // echo " ".$genWord;
                // if (isset($app->dictionary['glb'][$genWord])) echo "!";
                $genList[$genWord][] = "$currentPrefix-$currentRoot";
            }
        }
        $page->content .="<p>Generated ".sizeof($genList).' words.</p>';
        $page->content .= '<h3 style="color:black">Possibly conflicting words generated</h3> <ul>';
        ksort($genList);
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
        $page->content .= "</ul>";
    }
}
