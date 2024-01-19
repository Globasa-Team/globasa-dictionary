<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath ."partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="tags">

<? $exists = isset($defs[$tag]); ?>
<h1><?= $config->getTrans('single tag view') ?>: <?= $tag; ?></h1>
  <? if ($exists) : ?>
  <p>
    <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?= $defs[$tag]['class'];?></a>)</em>&nbsp;
    <?= $defs[$tag]['translation'] ?>
  </p>
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
        <dd>
        <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$defs[$word]['class'];?></a>)</em>&nbsp;
        <?=$defs[$word]['translation'];?>
        </dd>
      </div>
    <? endforeach; ?>
    </dl>
  <? endif; ?>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>