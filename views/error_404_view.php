<?php
namespace WorldlangDict;
header("HTTP/1.0 404 Not Found");
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>



<main>
  <h1>404: Page Not Found</h1>
</main>



<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>
</html>
