<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath ."partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="tags">

<? $exists = isset($defs[$tag]); ?>
<h1><?= $config->getTrans('single tag view') ?>: <?= $tag; ?></h1>
  <? if ($exists) : ?>
  <p><?= $defs[$tag] ?></p>
  <? endif; ?>
  <hr/>
  <? if (!empty($tags[$tag])): ?>

    <dl>
    <?php
    foreach($tags[$tag] as $word):
        if (!isset($defs[$word])) continue;
        $def = $defs[$word];
        
      ?>
      <div>
        <dt><?= WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($word),
                $request,
                $word
            ); ?></dt>
        <dd><?= $def ?>
        </dd>
      </div>
    <? endforeach; ?>
    </dl>
  <? endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>