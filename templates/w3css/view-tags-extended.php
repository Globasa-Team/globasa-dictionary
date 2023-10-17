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

<? $exists = isset($config->dictionary->words[$tag]); ?>
<h2><?= $exists ? $config->dictionary->words[$tag]->term : $tag; ?> &mdash; <?= $config->getTrans('tags title') ?></h2>
          <? if ($exists) : ?>
          <p><?= $config->dictionary->words[$tag]->translation[$request->lang]; ?></p>
          <? endif; ?>
          <? if (!empty($list)):
              require_once($config->templatePath . "partials/word-dl.php");
          endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>