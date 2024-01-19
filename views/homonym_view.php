<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<?

require_once($config->templatePath . "partials/page-header.php");
?>

<main class="homonyms">
<? require('views/homonym_view_part.php'); ?> 
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
