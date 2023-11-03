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

<main id="content" class="w3-main w3-container content-bg">

<? $exists = isset($defs[$tag]); ?>
<h1><?= $tag; ?> &mdash; <?= $config->getTrans('tags title') ?></h1>
          <? if ($exists) : ?>
          <p><?= $defs[$tag] ?></p>
          <? endif; ?>
          <hr/>
          <? if (!empty($tags[$tag])): ?>

            <dl class="dictionaryList tags_extended">
            <?php
            foreach($tags[$tag] as $word):
                if (!isset($defs[$word])) continue;
                $def = $defs[$word];
                
                ?>
                <dt><?= WorldlangDictUtils::makeLink(
                        $config,
                        'lexi/'.urlencode($word),
                        $request,
                        $word
                    ); ?></dt>
                <dd><?= $def ?>
            </dd>
            <? endforeach; ?>
            </dl>
          <? endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>