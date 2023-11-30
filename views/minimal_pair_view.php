<?php
namespace WorldlangDict;
?>


<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<?

require_once($config->templatePath . "partials/page-header.php");
?>

<main class="minimal_pair">

<div class="w3-container content-bg">
    <h1><?=$config->getTrans('minimum pair title');?></h1>
    <p><?=$config->getTrans('minimum pair description');?></p>
<?    
        if (isset($request->options['candidate'])) {
            $candidate = $request->options['candidate'];
        } else {
            $candidate = '';
        }
?>
        <div class="w3-card w3-container" style="padding: 5px">
        <form action="<?=WorldlangDictUtils::makeUri($config, 'tul/minimum-duaxey', $request);?>" method="get">
            <input name="candidate" placeholder="<?=$config->getTrans('minimum pair new placeholder');?>" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" value="<?=$candidate;?>" />
            <input type="submit" value="<?=$config->getTrans('minimum pair new button');?>" class="w3-btn w3-blue-grey" />
        </form>
        </div>
<?
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
        $d[0] = '';
        $d[1] = '';
        $d[2] = '';

        foreach ($nearMatches as $word=>$data) {
            foreach ($data as $match=>$distance) {
                $d[$distance] .= '<li>'.$word.': '. $match.'</li>';
            }
        }
?>

    <h2><?=sprintf($config->getTrans('minimum pair result diff'), '1');?></h2>
    <? if (empty($d[1])) : 
        $page->content .= $config->getTrans("none found");
    endif; ?>
    <ul><?=$d[1];?></ul>

    <h2><?=sprintf($config->getTrans('minimum pair result diff'), '2');?></h2>
    <? if (empty($d[2])):
        $page->content .= $config->getTrans("none found");
    endif; ?>
    <ul><?=$d[2]?></ul>
</div>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
