<?php
namespace WorldlangDict;

class ToolView {
    
    public static function toolList ($config, &$page) {
        $page->content .= '<h1>Tools test</h1>
                        
                        <div class="w3-card">
                            <header class="w3-container w3-green">
                                <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/homonym-terminator').'">Find homonyms</a></h2>
                            </header>
                            <div class="w3-container"><p>Find words that are too similar to suggested new words. Used when proposing a new Globasa word.</p>
                            </div>
                        </div>
                        
                        <div class="w3-card">
                            <header class="w3-container w3-green">
                                <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').'">Find minimal pairings</a></h2>
                            </header>
                            <div class="w3-container"><p>Find words that are too similar to a suggested new word by changing or adding a letter. Used when proposing a new Globasa word.</p>
                            </div>
                        </div>
                    ';

    }
}