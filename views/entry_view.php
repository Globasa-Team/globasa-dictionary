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
    <ul class="translation"><?

 if (!empty($entry['trans'][$config->lang])):
    foreach($entry['trans'][$config->lang] as $group):
        ?><ul><?    
        foreach($group as $translation):
            ?><li><span class="w3-tag w3-round w3-light-grey"><?=$translation?></span></li><?
        endforeach;
        ?></ul><?
    endforeach;
 else:
    echo(sprintf($config->getTrans("Missing Word Translation")));
 endif;
 
 ?></ul>
 
 
 
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
if (isset($entry['etymology']['natlang'])):
    $list = &$entry['etymology']['natlang'];
    include($config->templatePath . "partials/entry_language_list.php");
endif;

// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
    <p class="etymology">Kwasilexi</p>
    <? $list = &$entry['etymology']['kwasilexi'];
    include($config->templatePath . "partials/entry_language_list.php");
endif;

// am oko pia
if (isset($entry['etymology']['am oko pia'])): ?>
    <p class="etymology">Am oko pia</p>
    <? $list = &$entry['etymology']['am oko pia'];
    include($config->templatePath . "partials/entry_language_list.php");
endif;

// am oko
if (isset($entry['etymology']['am oko'])): ?>
    <p class="etymology">Am oko</p>
    <? $list = &$entry['etymology']['am oko'];
    include($config->templatePath . "partials/entry_word_list.php");
endif;

// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
    <p class="etymology">Am kompara</p>
    <? $list = &$entry['etymology']['am kompara'];
    include($config->templatePath . "partials/entry_word_list.php");
endif;

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
