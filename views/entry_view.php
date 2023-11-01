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
$page->description = $entry['term'] . ': ' . htmlspecialchars($entry['raw data']['trans'][$config->lang]);

require_once($config->templatePath . "partials/page-header.php");
?>

<main id="content" class="w3-main">


<div id="<?=$entry['term']?>" class="dictionaryEntry w3-card">
    <header class="w3-container">
        <h2 id="entryTerm"><?=$entry['term']?></h2>
<? if (!empty($entry['word class'])): ?>
    <div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/gramati/lexiklase"><?=$entry['word class']?></a>)</div>
<? endif; ?>
    </header>



<!--             -->
<!-- Translation -->
<!--             -->
<div class="w3-container">
    <p class="definition"><?

 if (!empty($entry['raw data']['trans'][$config->lang])):
    echo($entry['raw data']['trans'][$config->lang]);
 else:
    sprintf($config->getTrans("Missing Word Translation") );
 endif;
 
 ?></p>
 
 
 
 <!--             -->
 <!-- Examples    -->
 <!--             -->
 <? if (!empty($entry['examples'])): ?>
    <p><?=sprintf($config->getTrans('Example'), "")?></p>
    <ul class="examples">
    <? foreach($entry['examples'] as $example): ?>
        <li><?=$example?></li>
    <? endforeach; ?>
    </ul>
 <? endif; ?>
    


<!--             -->
<!-- Synonyms    -->
<!--             -->
<?
if (!empty($entry['synonyms'])):
    $words = [];
    if (count($entry['synonyms']) == 1) {
        $trans = 'synonym sentence';
    } else {
        $trans = 'synonyms sentence';
    }
    foreach ($entry['synonyms'] as $cur) {
        $words[] = WorldlangDictUtils::makeLink(
            $config,
            'lexi/'.$cur,
            $request,
            $cur
        );
    } ?>
        <p><?=sprintf($config->getTrans($trans), implode(', ', $words))?></p>
<? endif; ?>



<!--             -->
<!-- Antonyms    -->
<!--             -->
<?
if (!empty($entry['antonyms'])) {
    $words = [];
    if (count($entry['antonyms']) == 1) {
        $trans = 'antonym sentence';
    } else {
        $trans = 'antonyms sentence';
    }
    foreach ($entry['antonyms'] as $cur) {
        $words[] = WorldlangDictUtils::makeLink(
            $config,
            'lexi/'.$cur,
            $request,
            $cur
        );
    } ?>
        <p><?=sprintf($config->getTrans($trans), implode(', ', $words))?></p>
<? } ?>




<!--             -->
<!-- Etymology   -->
<!--             -->
<p class="etymology"><?= sprintf($config->getTrans('Etymology'), "")?></p>
<?

// Derived
if (isset($entry['etymology']['derived'])): ?>
        <p class="etymology" style="margin-left: 40px;"><?=$entry['etymology']['derived']?></p>
<? endif;

// Natlang
if (isset($entry['etymology']['natlang'])): ?>
        <ul style="list-style:none;"><?=WordView::list_langs_and_examples($entry['etymology']['natlang'])?></ul>
<? endif;

// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
    <p class="etymology">Kwasilexi</p>
    <ul style="list-style:none;"><?=WordView::list_langs_and_examples($entry['etymology']['kwasilexi'])?></ul>
<? endif;

// am oko pia
if (isset($entry['etymology']['am oko pia'])): ?>
    <p class="etymology">Am oko pia</p>
    <ul style="list-style:none;"><?=WordView::list_langs_and_examples($entry['etymology']['am oko pia'])?></ul>
<? endif;

// am oko
if (isset($entry['etymology']['am oko'])): ?>
    <p class="etymology">Am oko</p>
    <ul style="list-style:none;"><?=WordView::list_to_ul($entry['etymology']['am oko'])?></ul>
<? endif;

// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
        <p class="etymology">Am kompara</p>
        <ul style="list-style:none;"><?=WordView::list_to_ul($entry['etymology']['am kompara'])?></ul>
<? endif;

// link
if (isset($entry['etymology']['link'])): ?>
        <p class="etymology"><?=$entry['etymology']['link']?></p>;
<? endif; ?>



<!--                 -->
<!-- Related Words   -->
<!--                 -->
<? if (!empty($entry['relatedWords'])):
    foreach ($entry['relatedWords'] as $i=>$cur) {
        $entry['relatedWords'][$i] = WorldlangDictUtils::makeLink($config, 'lexi/'.$cur, $request, $cur);
    } ?>
    <p class="alsosee"><?=sprintf($config->getTrans('Also See Sentence'), implode(', ', $entry['relatedWords']))?></p>
<? endif; ?>



<!--         -->
<!-- Tags    -->
<!--         -->
<? if (!empty($entry['tags'])):
    foreach ($entry['tags'] as $i=>$tag) {
        $entry['tags'][$i] = WorldlangDictUtils::makeLink(
            $config,
            "lexilari/".$tag,
            $request,
            $tag
        );
    } ?>
    <p class="tags"><?=sprintf($config->getTrans('tags links'), implode(', ', $entry['tags']))?></p>
<? endif; ?>



</div>



<!--                 -->
<!-- Entry Footer    -->
<!--                 -->
<footer class="w3-container">
    <?=WorldlangDictUtils::makeLink($config, 'lexi/'.$entry['term'], $request,
        '<span class="fa fa-link"></span> '.$config->getTrans('Word Link')) ?>
    &bull; <a href="'.$entry['ipa link'].'"><span class="fa fa-volume-up"></span> <?=$config->getTrans('ipa link')?></a>
</footer>

</div>
    
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
