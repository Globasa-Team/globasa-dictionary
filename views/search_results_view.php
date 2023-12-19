<?php namespace WorldlangDict; ?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>

<h1><?=$term.': '.$config->getTrans('natlang search title bar')?></h1>

<? if (sizeof($results)) : ?>
<dl class="dictionaryList">
    
    <? foreach ($results as $word) :
        if (!file_exists($config->api2Path."terms/{$word}.yaml")) {
            // TODO: Error handling by saying or logging the error
            continue;
        }
        $entry = yaml_parse_file($config->api2Path."terms/{$word}.yaml");
        if (empty($entry['term'])) return ""; ?>
        <div>
        <dt {$data}><?
            echo(WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($entry['slug']),
                $request,
                $entry['term']
            ));
        if (isset($entry['word class']) && !empty($entry['word class'])) :
            ?><span class="wordClass">(<a href="https://xwexi.globasa.net/'<?=$config->lang;?>'/gramati/lexiklase"><?=$entry['word class'];?></a>)</span><?
        endif;
        ?></dt>
        <dd><?=$entry['trans html'][$config->lang];?></dd>
        </div>
<? endforeach; ?>
</dl>

<? else:
    // Otherwise, say nothing was found.
    echo($config->getTrans('no matches found'));
endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>