<?php
namespace WorldlangDict;

class ToolView
{
    public static function toolList($config, &$page, $request)
    {
        $page->content .= '<h1>'.$config->getTrans('tools button').'</h1>


            <div class="w3-card">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/translation-aide', $request).'">'.$config->getTrans('translation aide title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('translation aide description').'</p>
                </div>
            </div>


            <div class="w3-card">
                <header class="w3-container">
                    <h2>'.$config->getTrans('candidate check title').'</h2>
                </header>
                <p><div class="w3-container">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/candidate-check", $request) .'" method="get">
                <input name="candidate" placeholder="'.$config->getTrans('candidate check placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
                <input value="'.$config->getTrans('candidate check button').'" type="submit" class="w3-btn w3-blue-grey" />
                </form></p>
                <p>'.$config->getTrans('candidate check description').'</p>
                </div>
            </div>

            <div class="w3-card">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/homonym-check', $request).'">'.$config->getTrans('homonym terminator title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('homonym terminator description').'</p>
                </div>
            </div>

            <div class="w3-card">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/minimal-pair-detector', $request).'">'.$config->getTrans('minimum pair title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('minimum pair description').'</p>
                </div>
            </div>
            

        ';
    }

    public static function homonymCheckTitle($config, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('homonym terminator title').'</h1>'.
            '<p>'.$config->getTrans('homonym terminator description').'</p>';
    }

    public static function homonymCheckInput($config, $request, &$page)
    {
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/homonym-check", $request) .'" method="get">
                <input name="candidate" placeholder="'.$config->getTrans('homonym terminator new placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
                <input type="submit" value="'.$config->getTrans('homonym terminator new button').'" class="w3-btn w3-blue-grey" />
                </form>
            </div>';
    }

    public static function homonymCheck($config, $request, $genList, &$page)
    {
        $result = '';

        if (isset($config->dictionary->words[$request->options['candidate']])) {
            $page->content .= "<h3>" .$config->getTrans('homonym terminator word exists title'). "</h3>
                <p>". sprintf(
                        $config->getTrans('homonym terminator word exists'),
                        WorldlangDictUtils::makeLink(
                            $config,
                            'lexi/'.$request->options['candidate'],
                            $request,
                            $request->options['candidate']
                        )
                    )."</p>
                ";
        }
        foreach ($genList as $genWord=>$sources) {
            // Show all or only show ones related to the root.
            if (sizeof($sources)>1 && (!isset($request->options['candidate']) || isset($sources[$request->options['candidate']]))) {
                if (isset($config->dictionary->words[$genWord])) {
                    $definition = '</br>'.$config->dictionary->words[$genWord]->translation['eng'];
                } else {
                    $definition = "";
                }
                $result .= '<li><span style="font-weight: bold; font-size: larger;">['.$genWord."]</span><br />".$config->getTrans('homonym terminator conflicting msg').
                    " ". implode($sources, ', ').$definition."</li>";
            }
        }

        if (!empty($result)) {
            $page->content .= "<ul>".$result."</ul>";
        } else {
            $page->content .= "<h3>".$config->getTrans('homonym terminator none found')."</h3>";
        }
    }

    public static function minimalPairCheckTitle($config, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('minimum pair title').'</h1>'.
            '<p>'.$config->getTrans('minimum pair description').'</p>';
    }

    public static function minimalPairCheckInput($config, $request, &$page)
    {
        if (isset($request->options['candidate'])) {
            $candidate = $request->options['candidate'];
        } else {
            $candidate = '';
        }
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
            <form action="'.WorldlangDictUtils::makeUri($config, 'tul/minimal-pair-detector', $request).'" method="get">
                <input name="candidate" placeholder="'.$config->getTrans('minimum pair new placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" value="'.$candidate.'" />
                <input type="submit" value="'.$config->getTrans('minimum pair new button').'" class="w3-btn w3-blue-grey" />
            </form>
            </div>
        ';
    }

    public static function minimalPairCheck($config, $request, $nearMatches, &$page)
    {
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
        $d[0] = '';
        $d[1] = '';
        $d[2] = '';

        foreach ($nearMatches as $word=>$data) {
            foreach ($data as $match=>$distance) {
                $d[$distance] .= '<li>'.$word.': '. $match.'</li>';
            }
        }

        $page->content .='<h2>'.sprintf($config->getTrans('minimum pair result diff'), '1').'</h2>';
        if (!empty($d[1])) {
            $page->content .= '<ul>'.$d[1].'</ul>';
        } else {
            $page->content .= $config->getTrans("none found");
        }

        $page->content .= '<h2>'.sprintf($config->getTrans('minimum pair result diff'), '2').'</h2>';
        if (!empty($d[2])) {
            $page->content .= '<ul>'.$d[2].'</ul>';
        } else {
            $page->content .= $config->getTrans("none found");
        }
    }

    
    public static function transAideTitle($config, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('translation aide title').'</h1>'.
            '<p>'.$config->getTrans('translation aide description').'</p>';
    }

    public static function transAideInput($config, $request, &$page)
    {
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/translation-aide", $request) .'" method="post">
                <textarea name="text" placeholder="'.$config->getTrans('translation aide placeholder').'" class="w3-input w3-border w3-light-grey" >
Bimaryen side in calunkursi in hospital.
Te wawa.
Bante swal tas te ki te wawa kuseba.
Bimaryen jawabu ki te le ore banto.
Insan swal tas te, "Yu le ore keto?"
Bimaryen jawabu, "Mi le ore: Am no befobi, moyto xa sen bon."
Insan loga, "Dento sen bon!"
Bimaryen jawabu, "Mas dento beloga kanhoyen tas medisyen!"
                </textarea>
                <input type="submit" value="'.$config->getTrans('translation aide translate button').'" class="w3-btn w3-blue-grey" />
                </form>
            </div>';
    }

    public static function transAideResults($config, $request, $words, &$page)
    {
        $dic = $config->dictionary->words;
        $result = '';
        
        if (!empty($words)) {

            $result = '<ul>';
            foreach($words as $word) {
                
                if (!empty($word) && !empty($dic[$word])) {
                    $trans = $dic[$word]->translation['eng'];
                }
                else if (!empty($dic[$word])) {
                    $trans = '[Translation not found]';
                }
                else {
                    // Line feed / new paragraph
                    $result .= '</ul><ul>';
                    continue;
                }
                $result .= '<li>'.$word.': '.$trans.'</li>';
            }
            $result .= '</ul>';
        }

        if (!empty($result)) {
            $page->content .= "".$result."";
        }
    }

}
