<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlangs">

<h1><?=$config->getTrans('natlangs title');?></h1>


<ul>
<? foreach($data['source langs'] as $natlang=>$count) {
  if (!in_array($natlang, OFFICIAL_NATLANGS)) {
    continue;  
  }
  ?>
  <li><strong><?= WorldlangDictUtils::makeLink($config, "natlangs/".$natlang, $request, $natlang); ?></a></strong> (<?= $count; ?>)</li>
<? } ?>
</ul>



</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
