<?php
namespace GlobasaDictionary;

/**
 * Calls the appropriate function based on the url.
 */
function processRequest($app, $appOld = null)
{
    $app->page = new \stdClass();
    $parsedUrl = parse_url(strtolower($_SERVER['REQUEST_URI']));
    $app->page->path = explode('/', $parsedUrl['path']);
    $app->page->title = $app->siteName;
    $app->page->content = "";
    
    if (isset($parsedUrl['query'])) {
        $app->page->linkQuery = '?'.$parsedUrl['query'];
        parse_str($parsedUrl['query'], $app->page->options);
        processOptions($app);
    } else {
        $app->page->linkQuery = null;
    }
    
    // Find num of parameters by comparing path to URI (minus 3 for domain)
    $requestSize = sizeof($app->page->path);
    if (empty($app->page->path[$requestSize-1])) {
        $requestSize -= 1;
    }
    $requestSkip = sizeof(explode('/', $app->siteUri))-3;
    $requestSize = $requestSize-$requestSkip;
    
    // Let's get to the content!
    if ($requestSize == 0) {
        $app->setLang('eng');
        showWordList($app);
    } elseif ($requestSize == 1) {
        $app->setLang($app->page->path[$requestSkip]);
        showWordList($app);
    } elseif ($requestSize == 2) {
        $app->setLang($app->page->path[$requestSkip]);
        $app->request = $app->page->path[$requestSkip+1];
        switch ($app->request) {
            case 'glb-words': case 'eng-words': case 'epo-words': case 'fra-words': case 'spa-words': case 'rus-words': case 'zho-words':
                $listLanguage = explode('-', $app->request)[0];
                showWordList($app, $listLanguage);
                break;
            default:
                showWord($app, $app->request);
        }
    } elseif ($requestSize == 3) {
        $app->setLang($app->page->path[$requestSkip]);
        $request = $app->page->path[$requestSkip+1];
        $listLanguage = explode('-', $request)[0];
        $word = $app->page->path[$requestSkip+2];
        $app->request = $request.'/'.$word;
        showWord($app, $word, $listLanguage);
    }
}

function processOptions($app)
{
    foreach ($app->page->options as $option=>$value) {
        switch ($option) {
            case 'template':
                $app->template = $value;
                $app->templatePath = "./".$app->templatesFolder.'/'.$app->template.'/';
                $app->templateUri = $app->siteUri.$app->templatesFolder.'/'.$app->template.'/';
        }
    }
}

function showWordList($app, $listLang='glb') {
    $list = new WordList($app, $listLang);
    $app->page->content .= $list->get();
    include_once($app->templatePath.'index.php');
}


function showWordListOld($app, $listLang='glb')
{
    $langCap = ucfirst($app->lang);
    // echo "-showWordList $listLang-";
    foreach ($app->dictionary[$listLang] as $displayWord=>$word) {
        if ($listLang != 'glb') {
            // echo("-not globasa-");
            $app->page->content .= "<p>$listLang $displayWord</p>";
            $displayWord = $word;
            $word = $app->dictionary['glb'][$word];
        }
        
        addWord($app, $word, $listLang);
    }
    include_once($app->templatePath.'index.php');
}

function showWord($app, $wordRequest, $wordLang='glb')
{
    if (isset($app->dictionary[$wordLang][$wordRequest])) {
        $word = $app->dictionary[$wordLang][$wordRequest];
        if ($wordLang != 'glb') {
            $app->page->content .= "<p>".sprintf($app->getTrans('Entries for', $wordRequest))."</p>";
            $displayWords = explode(', ', $word);
            foreach ($displayWords as $displayWord) {
                $word = $app->dictionary['glb'][$displayWord];
                addWord($app, $word);
            }
        }
        else {
            addWord($app, $word);
        }
    } else {
        $app->page->content .= '<h1>'.$app->getTrans("Word Not Found Title").'</h1>'.'<p>'.sprintf($app->getTrans("Word Not Found Explaination"), $word, $wordLang).'</p>';
    }
    include_once($app->templatePath.'index.php');
}

// function addWordNew($app, $word) {
function addWord($app, $word) {
    $displayWord = new Word($app, $word);
    $app->page->content .= $displayWord->get();
}

