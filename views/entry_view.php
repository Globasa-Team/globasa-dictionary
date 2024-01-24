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
        &nbsp; <a href="<?=$entry['ipa link']?>"><span class="fa fa-volume-up"></span> <?=$config->getTrans('ipa link')?></a>
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
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'cel-ruke/'.$translation, $request) ?>" class="hl green"><?=$translation?></a><?
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
require_once('views/entry_view_etymology.php');
?>


<?
/**
 * Derived Words
 */

if (array_key_exists('derived terms', $entry)): ?>
<section class="derived_words">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
            <?
            foreach(array_keys($entry['derived terms']) as $term) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$term, $request); ?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$term;?></a> <?
            endforeach;

            ?> <span class="hl green">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
        <dl>
<?
        foreach($entry['derived terms'] as $a_term=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.urlencode($a_term),
                    $request,
                    $a_term
                );?></dt>
                <dd>
                <? if (isset($data['class'])) : ?>
                    <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$data['class'];?></a>)</em>&nbsp;
                <? endif; ?>
                    <?=$data['trans'][$request->lang];?>
                </dd>
            </div>
        <? endforeach; ?>
        </dl>
    </details>
</section>
<? endif;






/**
 * Rhyming
 */
if (array_key_exists('rhyme trans', $entry)): ?>
<section class="rhymes">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('entry rhyming words'), '');?></h2>
            <?
            foreach(array_keys($entry['rhyme trans']) as $term) :
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$term, $request); ?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$term;?></a> <?
            endforeach;

            ?> <span class="hl green">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('entry rhyming words'), '');?></h2>
        <dl>
<?
        foreach($entry['rhyme trans'] as $a_term=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                        $config,
                        'lexi/'.urlencode($a_term),
                        $request,
                        $a_term
                    );?></dt>
                <dd>
                <? if (isset($data['word class'])) : ?>
                    <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$data['word class'];?></a>)</em>&nbsp;
                <? endif; ?>
                    <?=$data[$request->lang];?> 
                </dd>
            </div>
        <? endforeach; ?>
        </dl>
    </details>
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
<? endif; ?>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
