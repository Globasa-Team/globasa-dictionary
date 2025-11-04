<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<?php require_once($config->templatePath ."partials/html-head.php"); ?>
<body>


<?php require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="tags">

<?php $exists = isset($defs[$tag]); ?>
<?php if ($exists) : ?>
  <h1><?= $config->getTrans('single tag view') ?>: <?= $defs[$tag]['term']; ?></h1>
  <p>
    <em>(<a href="<?=$config->grammar_url;?>"><?= $defs[$tag]['class'];?></a>)</em>&nbsp;
    <?= $defs[$tag]['translation'] ?>
  </p>
  <?php else : ?>
    <h1><?= $config->getTrans('single tag view') ?>: <?= $tag; ?></h1>
  <?php endif; ?>
  
  <?php $rand = $tags[$tag][array_rand($tags[$tag])]; ?>
  <p>
    <a class="button" href=""><?= $config->getTrans('tags random word') ?></a><br/>
    <a href="<?= WorldlangDictUtils::makeUri(
                config:$config, request:$request,
                controller:'word', arg:urlencode($rand)
            ); ?>"><?= $defs[$rand]['term'] ?></a>
    <em>(<a href="<?=$config->grammar_url;?>"><?= $defs[$rand]['class'];?></a>)</em>&nbsp;
    <?= $defs[$rand]['translation'] ?>
  </p>
  
  <?php if (!empty($tags[$tag])): ?>

    <dl>
    <?php
    foreach($tags[$tag] as $slug):
        if (!isset($defs[$slug])) continue;
        $def = $defs[$slug];
        
      ?>
      <div>
        <dt><?= WorldlangDictUtils::makeLink(
                config:$config, request:$request,
                controller:'word', arg:urlencode($slug),
                text:$defs[$slug]['term']
            ); ?></dt>
        <dd>
        <em>(<a href="<?=$config->grammar_url;?>"><?=$defs[$slug]['class'];?></a>)</em>&nbsp;
        <?=$defs[$slug]['translation'];?>
        </dd>
      </div>
    <?php endforeach; ?>
    </dl>
  <?php endif; ?>

</main>

<?php require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>