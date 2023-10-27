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
<dl class="">
<?
foreach ($tags as $tag=>$words):
    $exists = isset($defs[$tag]);
?>

    <dt class="">
            <span><?= WorldlangDictUtils::makeLink($config, "lexilari/".$tag, $request, $tag); ?></span>
            <span class="w3-badge w3-tiny w3-blue"><?=count($words) ?></span>
        </dt>
        <dd>
            <?= ($exists ? $defs[$tag] : '&nbsp;')  ?>
        </dd>

<?php endforeach; ?>
</dl>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>