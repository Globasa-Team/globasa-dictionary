<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once("partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="content" class="w3-main">

<h1><?= $config->getTrans('tags title') ?></h1>
<ul class="w3-ul">
<?
foreach ($tags as $tag=>$words):
    // foreach ($words as $i=>$word):
    //     $words[$i] = WorldlangDictUtils::makeLink($config, "lexi/".$word, $request, $word);
    // endforeach;
    $exists = isset($config->dictionary->words[$tag]);
?>
    <div class="w3-card" style="display:none;">
        <header class="w3-container"><h2><?= WorldlangDictUtils::makeLink($config, "lexilari/".$tag, $request, $exists ? $config->dictionary->words[$tag]->term : $tag); ?></h2></header>
        <div class="w3-container">
            <? if ($exists) : ?>
            <p><?= $config->dictionary->words[$tag]->translation[$request->lang]; ?></p>
            <? endif; ?>
            <? if (!empty($words)): ?>
                <p class="tags"><?= implode(', ', $words); ?> </p>
            <? endif; ?>
        </div>
    </div>

    <li class="w3-padding-small">
            <span class="w3-large"><?= WorldlangDictUtils::makeLink($config, "lexilari/".$tag, $request, $exists ? $config->dictionary->words[$tag]->term : $tag); ?>
            </span>(<?=count($words) ?>)
            <? if ($exists) : ?>
            <?= $config->dictionary->words[$tag]->translation[$request->lang]; ?>
            <? endif; ?>
    </li>


<?php endforeach; ?>
</ul>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>