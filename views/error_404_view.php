<?php
namespace WorldlangDict;
http_response_code(404);
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
