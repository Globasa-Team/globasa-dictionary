<?php
namespace WorldlangDict;

// Create page description metadata
$trans = [];
if (isset($entry['trans'][$config->lang])) {
    foreach($entry['trans'][$config->lang] as $trans_group) {
        $trans[] = implode(", ", $trans_group);
    }
} elseif (!isset($entry['trans'])) {
    error_log("No translations at all for entry in `entry_view.php`: ".serialize($entry));
}
$trans = implode("; ", $trans);

$page->description = $entry['term'] . ': ' . htmlspecialchars($trans);



?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<?php require_once($config->templatePath . "partials/html-head.php"); ?>
<body>
<?php


require_once($config->templatePath . "partials/page-header.php");


?>
<main class="entry">
    <header>
        <h1><?=$entry['term']?></h1>
<?php if (!empty($entry['word class'])): ?>
        <div class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$entry['word class']?></a>)</div>
<?php endif; ?>
        &nbsp; <a href="https://ipa-reader.com/?voice=Ewa&text=<?=$entry['ipa']?>"><span class="fa fa-volume-up"></span></a>
    </header>
    <div class="col1">
<?php



//region Translation
require_once('views/entry_view_translations.php');
//endregion



//region Examples
require_once('views/entry_view_examples.php');
//endregion



//region Vocabulary Tags
if (!empty($entry['tags'])):
    foreach ($entry['tags'] as $i=>$tag) {
        $entry['tags'][$i] = WorldlangDictUtils::makeLink(
            config:$config, request:$request,
            controller:'tag', arg:$tag,
            text:$tag
        );
    } ?>
<section>
    <h2><?=sprintf($config->getTrans('tags links'), ""); ?></h2>
    <?= implode(', ', $entry['tags']); ?>
</section>
<?php endif;
//endregion



//region Synonyms
if (!empty($entry['synonyms'])):
    $trans =  (count($entry['synonyms']) == 1) ? 'synonym sentence' : 'synonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?php
        foreach ($entry['synonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                controller:'word', arg:$cur,
                config:$config, request: $request
            );?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$cur;?></a> <?php
        endforeach; ?>
    </section>
<?php endif;
//endregion



//region Antonyms
if (!empty($entry['antonyms'])):
    $trans =  (count($entry['antonyms']) == 1) ? 'antonym sentence' : 'antonyms sentence';
    ?>
    <section>
        <h2><?=sprintf($config->getTrans($trans), "");?></h2>
        <?php
        foreach ($entry['antonyms'] as $cur) :
            ?><a href="<?=WorldlangDictUtils::makeUri(
                controller:'word', arg:$cur,
                config:$config, request: $request
            );?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$cur;?></a> <?php
        endforeach; ?>
    </section>
<?php endif;
//endregion



//region Derived Words
if (array_key_exists('derived terms', $entry)): ?>
<section class="derived_words">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
            <?php
            foreach($entry['derived terms'] as $slug=>$data) :
                if (!isset($data['term'])) {
                    // Debugging for undefined key `term` on $data, using ?? $slug on lines below which may be temp fix.
                    error_log("Index 'term' does not exist on data for derived term '{$slug}' in `entry_view.php`. Serialized data: ".serialize($entry)."\n");
                }
                ?><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'word', arg:$slug, request:$request); ?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$data['text'] ?? $slug;?></a> <?php
            endforeach;

            ?> <span class="hl h1">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('derived word list'), '');?></h2>
        <dl>
<?php
        foreach($entry['derived terms'] as $a_term=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                    controller:'word', arg:urlencode($a_term),
                    config:$config, request:$request,
                    text: $data['text'] ?? $a_term
                );?></dt>
                <dd>
                <?php if (isset($data['class'])) : ?>
                    <em>(<a href="<?=$config->grammar_url;?>"><?=$data['class'];?></a>)</em>&nbsp;
                <?php endif ?>
                <?php if (isset($data['trans'][$request->lang])) : ?>
                    <?=$data['trans'][$request->lang];?>
                <?php endif; ?>
                </dd>
            </div>
        <?php endforeach; ?>
        </dl>
    </details>
</section>
<?php endif;
//endregion



// Start of next column.
?>
    </div>
    <div class="col2">
<?php



//region Etymology
require_once('views/entry_view_etymology.php');
//endregion



//region Natlang similar words
if (isset($entry['etymology']['natlang similar'])): ?>
<section class="natlang_similar">
    <h2><?= $config->getTrans('entry natlang similar header'); ?>:</h2>
    <?php
    $list = &$entry['etymology']['natlang similar'];
    include($config->templatePath . "partials/entry_language_list.php");
    ?>
</section>
<?php endif;
//endregion



//region Rhyming
if (array_key_exists('rhyme', $entry)): 
    if (isset($entry['rhyme exclusions'])) {
        foreach($entry['rhyme exclusions'] as $key=>$ex) {
            $entry['rhyme exclusions'][$key] = '<a href='.WorldlangDictUtils::makeUri(config:$config, controller:'word', arg:$ex, request:$request).' class="hl encap" lang="'.WL_CODE_FULL.'">'.$ex.'</a>';
        }
        $exclusions = implode('/', $entry['rhyme exclusions']);
    } else {
        $exclusions = "";
    }
?>
<section class="rhymes">
    <details>
        <summary class="hide">
            <h2><?=sprintf($config->getTrans('entry rhymes header'), $exclusions);?></h2>:
            <?php
            foreach($entry['rhyme'] as $rhyme_slug=>$rhyme_data) :
                ?><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'word', arg:$rhyme_slug, request:$request); ?>" class="hl encap" lang="<?=WL_CODE_FULL;?>"><?=$entry['rhyme'][$rhyme_slug]['term_spec'];?></a> <?php
            endforeach;

            ?> <span class="hl h1">[+]</span>
        </summary>
        <h2><?=sprintf($config->getTrans('entry rhymes header'), $exclusions);?></h2>:
        <dl>
<?php
        foreach($entry['rhyme'] as $rhyme_slug=>$data) : ?>
            <div>
                <dt><?=WorldlangDictUtils::makeLink(
                        config:$config, request:$request,
                        controller:'word', arg:urlencode($rhyme_slug),
                        text:$data['term_spec']
                    );?></dt>
                <dd>
                <?php if (isset($data['word class'])) : ?>
                    <em>(<a href="<?=$config->grammar_url;?>"><?=$data['word class'];?></a>)</em>&nbsp;
                <?php endif; ?>
                    <?=$data[$request->lang];?> 
                </dd>
            </div>
        <?php endforeach; ?>
        </dl>
    </details>
</section>
<?php endif;
//endregion



?>
</div> <!-- close .col2 -->
<?php


require_once('views/entry_view_debug.php');


/**
 * Entry footer
 */ 
?>
<footer>
    <?=WorldlangDictUtils::makeLink(config:$config, controller:'word', arg:$entry['term'], request:$request,
        text:'<span class="fa fa-link"></span> '.$config->getTrans('Word Link')) ?>
</footer>

</main>



<?php
require_once($config->templatePath . "partials/page-footer.php");
?>

</body>

</html>
