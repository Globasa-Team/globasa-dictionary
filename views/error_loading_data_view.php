<?php
namespace WorldlangDict;
http_response_code(500);
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>



<main>
    <h1>Server Error</h1>
    <p>There appears to be an issue loading the required data.</p>
</main>



<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>
</html>
