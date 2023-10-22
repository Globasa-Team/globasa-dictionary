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
    $exists = isset($defs[$tag]);
?>

    <li class="w3-padding-small">
            <span class="w3-large"><?= WorldlangDictUtils::makeLink($config, "lexilari/".$tag, $request, $tag); ?>
            </span>(<?=count($words) ?>)
            <? if ($exists) : ?>
            <?= $defs[$tag] ?>
            <? endif; ?>
    </li>

<?php endforeach; ?>
</ul>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>