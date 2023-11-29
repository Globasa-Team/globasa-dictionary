<?php
namespace WorldlangDict;

class ToolView
{
    public static function toolList($config, &$page, $request)
    {
        $page->content .= '<h1>'.$config->getTrans('tools button').'</h1>


            <div class="w3-card content-bg">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request).'">'.$config->getTrans('translation aide title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('translation aide description').'</p>
                </div>
            </div>


            <div class="w3-card content-bg">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/ifa-trasharufitul', $request).'">'.$config->getTrans('ipa converter title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('ipa converter description').'</p>
                </div>
            </div>


            <div class="w3-card content-bg">
                <header class="w3-container">
                    <h2>'.$config->getTrans('candidate check title').'</h2>
                </header>
                <p><div class="w3-container">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/kandidato-lexi", $request) .'" method="get">
                <input name="candidate" placeholder="'.$config->getTrans('candidate check placeholder').'" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
                <input value="'.$config->getTrans('candidate check button').'" type="submit" class="w3-btn w3-blue-grey" />
                </form></p>
                <p>'.$config->getTrans('candidate check description').'</p>
                </div>
            </div>

            <div class="w3-card content-bg">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/samaeskri-lexi', $request).'">'.$config->getTrans('homonym terminator title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('homonym terminator description').'</p>
                </div>
            </div>

            <div class="w3-card content-bg">
                <header class="w3-container">
                    <h2><a href="'.WorldlangDictUtils::makeUri($config, 'tul/minimum-duaxey', $request).'">'.$config->getTrans('minimum pair title').'</a></h2>
                </header>
                <div class="w3-container"><p>'.$config->getTrans('minimum pair description').'</p>
                </div>
            </div>
            

        ';
    }

    public static function minimalPairCheckTitle($config, &$page)
    {
        $page->content .= '<div class="w3-container content-bg"><h1>'.$config->getTrans('minimum pair title').'</h1>'.
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
            <form action="'.WorldlangDictUtils::makeUri($config, 'tul/minimum-duaxey', $request).'" method="get">
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
        $page->content .="</div>";
    }

    
    public static function transAideTitle($config, &$page)
    {
        $page->content .= '<div class="w3-card w3-container content-bg"><h1>'.$config->getTrans('translation aide title').'</h1>'.
            '<p>'.$config->getTrans('translation aide description').'</p></div>';
    }

    public static function transAideInput($config, $request, &$page)
    {
        $words = isset($_REQUEST['text']) ? $_REQUEST['text'] : null;
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/basatayti", $request) .'" method="post">
                <textarea name="text" class="w3-input w3-border w3-light-grey" >'.$words.'</textarea>
                <input type="submit" value="'.$config->getTrans('translation aide translate button').'" class="w3-btn w3-blue-grey" />
                </form>
            </div>';
    }


    public static function transAideResults($config, $request, $sentences, &$page)
    {
        $dic = $config->dictionary->words;
        $result = '';

        if (!empty($sentences)) {

            $result = '<div class="w3-card w3-container content-bg"><ul class="translationAide">';
            foreach($sentences as $current) {
                $result .= '<li>'.$current->sentence.'<ul>';
                foreach($current->words as $word) {
                    $wordClass = "";
                    $trans = "";
                    
                    if (!ctype_alpha($word)) {
                        continue;
                    }

                    if (!empty($word) && !empty($dic[$word]) && !empty($dic[$word]->translation[$config->lang])) {
                        $trans = $dic[$word]->translation[$config->lang];
                    }
                    else if (!empty($word) && !empty($dic[$word]) && empty($dic[$word]->translation[$config->lang])) {
                        $trans = '[Translation not found in this language]';
                    }
                    else {
                        // Line feed / new paragraph
                        $trans = '[Word not found in dictionary]';
                    }

                    if (isset($dic[$word])) {
                        if (!empty($dic[$word]->wordClass)) {
                            $wordClass = " <div class=\"wordClass\">({$dic[$word]->wordClass})</div>";
                        }
                        $word = WorldlangDictUtils::makeLink(
                            $config,
                            'lexi/'.urlencode($word),
                            $request,
                            $dic[$word]->term
                        );
                    }
                    $result .= '<li>'.$word.$wordClass.': '.$trans.'</li>';
                }
                $result .= '</ul></li>';
            }
            $result .= '</ul></div>';
        }

        if (!empty($result)) {
            $page->content .= "".$result."";
        }
    }

}
