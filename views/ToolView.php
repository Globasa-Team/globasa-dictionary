<?php
namespace WorldlangDict;

class ToolView
{
    public static function toolList($config, &$page)
    {
        $page->content .= '<h1>Tools test</h1>
                
                <div class="w3-card">
                    <header class="w3-container w3-blue">
                        <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/homonym-terminator').'">Find homonyms</a></h2>
                    </header>
                    <div class="w3-container"><p>Find words that are too similar to suggested new words. Used when proposing a new Globasa word.</p>
                    </div>
                </div>
                
                <div class="w3-card">
                    <header class="w3-container w3-blue">
                        <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').'">Find minimal pairings</a></h2>
                    </header>
                    <div class="w3-container"><p>Find words that are too similar to a suggested new word by changing or adding a letter. Used when proposing a new Globasa word.</p>
                    </div>
                </div>
            ';
    }
    
    public static function homonymTerminator($config, $genList, &$page) {
        $page->content .= "<h1>Find Homonyns</h1>";
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tule/homonym-terminator") .'" method="get">
                <input name="root" placeholder="New root" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
                <input type="submit" class="w3-btn w3-blue-grey" />
                </form>
            </div>';
        // var_dump($genList);
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
    
    public static function minimalPairDetector ($config, $request, $nearMatches, &$page) {
        
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
        
        $page->content = '';
        $page->content .= "<h1>Find minimal pairings</h1>";
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
            <form action="'.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').'" method="get">
                <input name="word" placeholder="Enter new word" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" value="'.$searchTerm.'" />
                <input type="submit" value="Find pairs" class="w3-btn w3-blue-grey" />
            </form>
            </div>
        ';
        
        $numWords = sizeof($words);
        
        foreach ($nearMatches as $word=>$data) {
            foreach ($data as $match=>$distance) {
                if ($distance == 1) {
                    $d1 .= '<li>'.$word.': '. $match.'</li>';
                }
                if ($distance == 2) {
                    $d2 .= '<li>'.$word.': '. $match.'</li>';
                }
            }
        }
        
        $page->content .="<h2>Pairs with a difference of 1:</h2>
                    <ul>".$d1."</ul>
                    <h2>Pairs with a difference of 2:</h2>
                    <ul>".$d2."</ul>";
    }
}
