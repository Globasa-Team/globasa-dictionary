<?php
namespace WorldlangDict;
http_response_code(400);
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>



<main>
    <h1>400: Bad Request</h1>
    <p>This link requsted invalid data.</p>
</main>



<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>
</html>
