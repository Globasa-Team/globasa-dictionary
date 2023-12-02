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
    
}
