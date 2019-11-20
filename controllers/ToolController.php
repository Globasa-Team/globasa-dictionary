<?php
namespace GlobasaDictionary;

class ToolController {
    
    // public function __construct(&$app, $option)
    // {
        
    // }
    public static function run($app, $tool, $argument=null){
        switch($tool) {
            case 'homonym-terminator':
                return ToolController::homonymTerminator($app, $argument);
                break;
            case 'minimal-pair-detector':
                return ToolController::minimalPairDetector($app, $argument);
            default:
                die('no option set');
        }
    }
    
    public static function minimalPairDetector($app, $checkWord = null)
    {
        
        $result = "<h1>Find minimal pairings</h1>";
        $words = array_keys($app->dictionary['glb']);
        
        $numWords = sizeof($words);
        
        if (empty($checkWord)) {
            for($i = 0; $i < $numWords; $i++) {
                for($j = $i+1; $j < $numWords; $j++) {
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
            for($i = 0; $i < $numWords; $i++) {
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
        $result.="<h2>Pairs with a difference of 1:</h2>
                    <ul>".$d1."</ul>
                    <h2>Pairs with a difference of 2:</h2>
                    <ul>".$d2."</ul>";
        return $result;
    }
    
    public static function homonymTerminator($app, $newRoot = null)
    {
        $result = "<h1>Find Homonyns</h1>";
        $result .= '<form action="/globasa-dictionary/eng/tool/homonym-terminator" method="post"><input placeholder="New root" /><input type="submit" /></form>';
        // var_dump($_REQUEST);
        // var_dump($_SERVER);
        foreach($app->dictionary['glb'] as $word=>$entry) {
            if($entry['Category']=='root') {
                $root[]=$word;
                $genList[$word][] = 'From word list';
            } elseif ($entry['Category']=='affix' && $word[0]=='-') {
                $suffix[]= $word;
            } elseif ($entry['Category']=='affix') {
                $prefix[] = $word;
            }
        }
        
        if(!empty($newRoot)) {
            $root = [$newRoot];
        }
        
        $result.= '<p>Found '.sizeof($root).' root, '.sizeof($prefix).' prefixes and '.sizeof($suffix).' suffixes</p>';
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
        $result .="<p>Generated ".sizeof($genList).' words.</p>';
        $result .= '<h3 style="color:black">Possibly conflicting words generated</h3>';
        ksort($genList);
        foreach($genList as $genWord=>$genRoots)
        {
            if (sizeof($genRoots)>1) {
                if (isset($app->dictionary['glb'][$genWord])) {
                    $definition = '</br>'.$app->dictionary['glb'][$genWord][DefinitionEng];
                }
                else {
                    $definition = "";
                }
                $result .= '<li><span style="font-weight: bold; font-size: larger;">'.$genWord."</span><br />".
                    "conflicting roots: ". implode($genRoots, ', ').$definition."</li>";             
            }
        }
        $result = "<ul>".$result."</ul>";
        return $result;
    }
}