<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once("partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="content">
    <?php echo $page->content ?>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
