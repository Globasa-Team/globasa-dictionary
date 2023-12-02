<?php
namespace WorldlangDict;
?>

<div class="w3-card w3-container content-bg"><h1><?=$config->getTrans('translation aide title');?></h1>
<p><?=$config->getTrans('translation aide description');?></p></div>

            $words = isset($_REQUEST['text']) ? $_REQUEST['text'] : null;
        $page->content .= '
            <div class="w3-card w3-container" style="padding: 5px">
                <form action="'. WorldlangDictUtils::makeUri($config, "tul/basatayti", $request) .'" method="post">
                <textarea name="text" class="w3-input w3-border w3-light-grey" >'.$words.'</textarea>
                <input type="submit" value="'.$config->getTrans('translation aide translate button').'" class="w3-btn w3-blue-grey" />
                </form>
            </div>';

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
