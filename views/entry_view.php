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

<main class="dictionaryEntry">


    <header>
        <h1 id="entryTerm"><?=$entry['term']?></h1>
<? if (!empty($entry['word class'])): ?>
    <div class="wordClass">(<a href="https://xwexi.globasa.net/<?=$config->lang;?>/gramati/lexiklase"><?=$entry['word class']?></a>)</div>
<? endif; ?>
    </header>


<?
/**
 * Translation
 */ ?>
<section class="translation">
    <p><?

 if (!empty($entry['trans'][$config->lang])):
    $i = 0;
    foreach($entry['trans'][$config->lang] as $group):
        $j = 0;
        foreach($group as $translation):
            ?><span class="hl"><?=$translation?></span><?
            if (++$j < count($group)):
                ?>, <?
            endif;
        endforeach;
        if (++$i < count($entry['trans'][$config->lang])):
            ?>; <?
        endif;
    endforeach;
 else:
    echo(sprintf($config->getTrans("Missing Word Translation")));
 endif;
 
 ?></p>
</section>
 
 <?
 /**
  * Examples
  */
 if (!empty($entry['examples'])): ?>
    <section class="examples">
    <h2><?=sprintf($config->getTrans('Example'), "")?></h2>
    <? foreach($entry['examples'] as $example): ?>
    <blockquote>
        <p><?=$example?></p>
        <? if(isset($false)): ?><cite>&mdash; Source Here</cite><? endif; ?>
    </blockquote>
    <? endforeach; ?>
    </section>
 <? endif; ?>
    


<?
/**
 * Synonyms
 */
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
    <section>
    <h2><?=sprintf($config->getTrans($trans), "");?></h2>
    <?=implode(', ', $words);?>
    </section>
<? endif; ?>



<?
/**
 * Antonyms
 */
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
    <section>
    <h2><?=sprintf($config->getTrans($trans), "")?></h2>
    <?=implode(', ', $words)?>
    </section>
<? } ?>



<?
/**
 * Etymology
 */
?>
<section class="etymology">
<h2><?= sprintf($config->getTrans('Etymology'), "")?></h2>
<?

// A priori
if (!empty($entry['etymology']['a priori'])): ?>
    <p class="apriori"><em>a priori</em></p>
<? endif;

// Derived
if (isset($entry['etymology']['derived'])): ?>
        <p class="derived"><?=$entry['etymology']['derived']?></p>
<? endif;

// Natlang
if (isset($entry['etymology']['natlang'])):
    $list = &$entry['etymology']['natlang'];
    include($config->templatePath . "partials/entry_language_list.php");
endif;

// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
<div>
    <h3>Kwasilexi</h3>
    <? $list = &$entry['etymology']['kwasilexi'];
    include($config->templatePath . "partials/entry_language_list.php"); ?>
    </div>
<? endif;

// am oko pia
if (isset($entry['etymology']['am oko pia'])): ?>
<div>
    <h3>Am oko pia</h3>
    <?
    $list = &$entry['etymology']['am oko pia'];
    $item_class = "hl";
    include($config->templatePath . "partials/entry_word_list.php");
    ?>
</div>
<? endif;

// am oko
if (isset($entry['etymology']['am oko'])): ?>
<div>
    <h3>Am oko</h3>
    <?
    $list = &$entry['etymology']['am oko'];
    $item_class = "hl";
    include($config->templatePath . "partials/entry_word_list.php");
    ?>
    
</div>
<? endif;

// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
<div>
    <h3>Am kompara</h3>
    <?
    $list = &$entry['etymology']['am kompara'];
    $item_class = "hl";
    include($config->templatePath . "partials/entry_word_list.php");
    ?>
</div>
<? endif;


// link
if (isset($entry['etymology']['link'])): ?>
<p><?=$entry['etymology']['link']?></p>;
<? endif; ?>
</section>


<?
/**
 * Related Words
 */
if (!empty($backlinks[$entry['slug']])): ?>
<section>
    <h2 class="alsosee"><?=sprintf($config->getTrans('Also See Sentence'), '');?></h2>
    <?
    $list = &$backlinks[$entry['slug']];
    $item_class = "hl";
    include($config->templatePath . "partials/entry_word_list.php");
    ?>
</section>
<? endif; ?>


<?
/**
 * Tags
 */
if (!empty($entry['tags'])):
    foreach ($entry['tags'] as $i=>$tag) {
        $entry['tags'][$i] = WorldlangDictUtils::makeLink(
            $config,
            "lexilari/".$tag,
            $request,
            $tag
        );
    } ?>
<section>
    <h2><?=sprintf($config->getTrans('tags links'), ""); ?></h2>
    <?= implode(', ', $entry['tags']); ?>
</section>
<? endif; ?>



<?
/**
 * Entry footer
 */ ?>
<footer>
    <?=WorldlangDictUtils::makeLink($config, 'lexi/'.$entry['term'], $request,
        '<span class="fa fa-link"></span> '.$config->getTrans('Word Link')) ?>
    &bull; <a href="<?=$entry['ipa link']?>"><span class="fa fa-volume-up"></span> <?=$config->getTrans('ipa link')?></a>
</footer>
 
</main>

<? if (isset($config->debugging) && $config->debugging) : ?>
<details class="debug">
    <summary>🔍 Entry Inspector</summary>
    <pre>
        <?=yaml_emit($entry);?>
    </pre>
</details>
<details class="debug">
    <summary>🔍 Backlink Inspector</summary>
    <pre>
        <?=yaml_emit($backlinks[$entry['slug']]);?>
    </pre>
</details>
<? endif; ?>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
