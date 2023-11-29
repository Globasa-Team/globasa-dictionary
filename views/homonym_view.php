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

<main class="homonym">


<div class="w3-container content-bg">
    <h1><?=$config->getTrans('homonym terminator title');?></h1>
    <p><?=$config->getTrans('homonym terminator description');?></p>
    <div class="w3-card w3-container" style="padding: 5px">
        <form action="<?=WorldlangDictUtils::makeUri($config, "tul/samaeskri-lexi", $request);?>" method="get">
        <input name="candidate" placeholder="<?=$config->getTrans('homonym terminator new placeholder');?>" class="w3-input w3-border w3-light-grey" style="max-width: 400px; display:inline-block; margin-right: 10px;" />
        <input type="submit" value="<?=$config->getTrans('homonym terminator new button');?>" class="w3-btn w3-blue-grey" />
        </form>
    </div>

    

<?    
    if (empty($nearMatches)) {
        $page->content .= $config->getTrans("none found");
    }
?>
    <ul>
<?
        $searchTerm = isset($request->options['word']) ? $request->options['word'] : "";
        // $d[0] = '';
        // $d[1] = '';
        // $d[2] = '';

        // foreach ($nearMatches as $word=>$data) {
        //     foreach ($data as $match=>$distance) {
        //         $d[$distance] .= '<li>'.$word.': '. $match.'</li>';
        //     }
        // }

    foreach ($nearMatches as $word=>$generated_words):

        if (sizeof($generated_words)>1 && (!isset($request->options['candidate']) || isset($generated_words[$request->options['candidate']]))): ?>
            <li>
                <header><?=$word;?></header>
                <section>
                    <?=$config->getTrans('homonym terminator conflicting msg');?>
                    <? foreach($generated_words as $data): ?>
                        <span class="hl"><?
                        if (isset($data['pre'])) echo $data['pre'];
                        echo " <strong>".$data['root']."</strong> ";
                        if (isset($data['suf'])) echo $data['suf'];
                        ?></span>
                    <? endforeach; ?>
                    <? if (isset($dict[$word])): ?>
                    <blockquote><?=$dict[$word]['translation'];?></blockquote>
                    <? endif; ?>
                </section>
            </li>
        <? endif;
    endforeach; ?>
    </ul>
</div>

 
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
