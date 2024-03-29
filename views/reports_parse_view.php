<?php

namespace WorldlangDict;

// TODO: i18n

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="parse_report">

<h1>Parse report</h1>
<p>These are the notices generated the last time the word list was processed.</p>

<ol>
<? foreach($data as $notice) { ?>
  <li><strong><?= $notice['term']; ?></strong>: <?= $notice['msg']; ?></li>
<? } ?>
</ul>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
