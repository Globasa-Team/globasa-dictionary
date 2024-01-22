<?php
namespace WorldlangDict;

// Create page description metadata
$trans = [];
foreach($entry['trans'][$config->lang] as $trans_group) {
    $trans[] = implode(", ", $trans_group);
}
$trans = implode("; ", $trans);

$page->description = $entry['term'] . ': ' . htmlspecialchars($trans);
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="entry">


    <header>
        <h1><?=$entry['term']?></h1>
<? if (!empty($entry['word class'])): ?>
        <div class="wordClass">(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$entry['word class']?></a>)</div>
<? endif; ?>
    </header>


<?
/**
 * Translation
 */ ?>
<section class="translation">
    <p><?

if (!empty($entry['trans'][$request->lang])):
    $gstart = true;
    
    foreach($entry['trans'][$request->lang] as $group):
        if (!$gstart) :
            ?>; <?
        endif;
        $gstart = false;
        $tstart = true;
        
        
        foreach($group as $translation):
            if (!$tstart) :
                ?>, <?
            endif;
            $tstart = false;

            if (!str_contains($translation, '<')) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'cel-ruke/'.$translation, $request) ?>" class="hl"><?=$translation?></a><?
            else:
                ?><span class="hl"><?=$translation?></span><?
        endif;
        endforeach;
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
    $trans =  (count($entry['synonyms']) == 1) ? 'synonym sentence' : 'synonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?
        foreach ($entry['synonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                        $config,
                        'lexi/'.$cur,
                        $request
                    );?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$cur;?></a> <?
        endforeach; ?>
    </section>
<? endif; ?>



<?
/**
 * Antonyms
 */
if (!empty($entry['antonyms'])):
    $trans =  (count($entry['antonyms']) == 1) ? 'antonym sentence' : 'antonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?
        foreach ($entry['antonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                        $config,
                        'lexi/'.$cur,
                        $request
                    );?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$cur;?></a> <?
        endforeach; ?>
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
<p class="derived"><?
    foreach($entry['etymology']['derived'] as $part) {
        if ($part === ' + ' || $part === '+') { // TODO: remove one
            ?> <?= $part; ?> <?
        } elseif ($part === ',' || $part === ', ') { // TODO: remove one
            ?><?= $part; ?> <?
        } else {
            ?><a href="../lexi/<?= $part; ?>"><?= $part; ?></a><?
        }
    }
    ?></p>
<? endif;


// Natlang
if (isset($entry['etymology']['natlang'])): ?>
<div class="natlang">
<?
    $list = &$entry['etymology']['natlang'];
    include($config->templatePath . "partials/entry_language_list.php");
?>
</div>
<? endif; ?>

<?
// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
<div class="kwasilexi">
    <h3>Kwasilexi</h3>
    <? $list = &$entry['etymology']['kwasilexi'];
    include($config->templatePath . "partials/entry_language_list.php"); ?>
</div>
<? endif;

// am oko pia
if (isset($entry['etymology']['am oko pia'])): ?>
<div>
    <h3>Am oko pia</h3>
    <ul>
    <? foreach($entry['etymology']['am oko pia'] as $item): ?>
        <li class="hl encap"><?=$item;?></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;

// am oko
if (isset($entry['etymology']['am oko'])): ?>
<div>
    <h3>Am oko</h3>
    <ul>
    <? foreach($entry['etymology']['am oko'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;

// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
<div>
    <h3>Am kompara</h3>
    <ul>
    <? foreach($entry['etymology']['am kompara'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;


// link
if (isset($entry['etymology']['link'])): ?>
<p><?=$entry['etymology']['link']?></p>;
<? endif; ?>

</section>


<?
/**
 * Derived Words
 */

if (array_key_exists('also see', $entry)): ?>
<section class="alsosee">
    
    <details>
        <summary>
            <h2><?=sprintf($config->getTrans('Also See Sentence'), '');?></h2>
            <?
            foreach(array_keys($entry['also see']) as $term) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$term, $request); ?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$term;?></a> <?
            endforeach;

            ?> [+]
        </summary>
        <dl style="margin-inline-start:2em;">
            <?
        foreach($entry['also see'] as $a_term=>$data) :?>
            <? if (isset($data['class'])) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                        $config,
                        'lexi/'.urlencode($a_term),
                        $request,
                        $a_term
                    );?></dt>
                <dd>
                    <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$data['class'];?></a>)</em>&nbsp;
                    <?=$data['trans'][$request->lang];?>
                </dd>
            </div>
            <? else: ?>

            <div>
                <dt><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$a_term, $request); ?>"><?=$a_term;?></a></dt>
                <dd><?=$data[$request->lang];?></dd>
            </div>
            <? endif; ?>
        <? endforeach; ?>
        </dl>
    </details>
</section>
<? endif; ?>



<?
/**
 * Rhyming
 */
if (array_key_exists('rhymes', $entry)) :
?>
<section class="rhymes">
    <h2><?= sprintf($config->getTrans('entry rhyming words'), "")?></h2>
    <ul>
<? foreach($entry['rhymes'] as $rhyme) : ?>
        <li class="hl" lang="<?=GLB_CODE;?>"><?=
            WorldlangDictUtils::makeLink($config, "lexi/".$rhyme, $request, $rhyme);
            ?></li>
<? endforeach; ?>
    </ul>
</section>
<? endif; // rhymes ?>



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
<? endif; ?>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
