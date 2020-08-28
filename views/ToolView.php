<?php
namespace WorldlangDict;

class ToolView
{
    public static function toolList($config, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('tools button').'</h1>

                <div class="w3-card">
                    <header class="w3-container w3-blue">
                        <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/homonym-terminator').'">'.$config->getTrans('homonym terminator title').'</a></h2>
                    </header>
                    <div class="w3-container"><p>'.$config->getTrans('homonym terminator description').'</p>
                    </div>
                </div>

                <div class="w3-card">
                    <header class="w3-container w3-blue">
                        <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').'">'.$config->getTrans('minimum pair title').'</a></h2>
                    </header>
                    <div class="w3-container"><p>'.$config->getTrans('minimum pair description').'</p>
                    </div>
                </div>
            ';
    }

    public static function homonymTerminator($config, $request, $genList, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('homonym terminator title').'</h1>';
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tule/homonym-terminator") .'" method="get">
                <input name="root" placeholder="'.$config->getTrans('homonym terminator new placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
                <input type="submit" class="w3-btn w3-blue-grey" />
                </form>
            </div>';

        foreach ($genList as $genWord=>$sources) {
            // Show all or only show ones related to the root.
            if (sizeof($sources)>1 && (!isset($request->options['root']) || isset($sources[$request->options['root']]))) {
                if (isset($config->dictionary->words[$genWord])) {
                    $definition = '</br>'.$config->dictionary->words[$genWord]->translation['eng'];
                } else {
                    $definition = "";
                }
                $page->content .= '<li><span style="font-weight: bold; font-size: larger;">['.$genWord."]</span><br />".$config->getTrans('homonym terminator conflicting msg').
                    " ". implode($sources, ', ').$definition."</li>";
            }
        }
        $page->content .= "</ul>";
    }

    public static function minimalPairDetector($config, $request, $nearMatches, &$page)
    {
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";

        $page->content = '';
        $page->content .= '<h1>'.$config->getTrans('minimum pair title').'</h1>';
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
            <form action="'.WorldlangDictUtils::makeUri($config, 'tule/minimal-pair-detector').'" method="get">
                <input name="word" placeholder="'.$config->getTrans('minimum pair new placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" value="'.$searchTerm.'" />
                <input type="submit" value="'.$config->getTrans('minimum pair new button').'" class="w3-btn w3-blue-grey" />
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

        $page->content .='<h2>'.sprintf($config->getTrans('minimum pair result diff', '1')).'</h2>
                    <ul>'.$d1.'</ul>
                    <h2>'.sprintf($config->getTrans('minimum pair result diff', '2')).'</h2>
                    <ul>'.$d2.'</ul>';
    }
}
