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
    <p>Processing your request resulted in uncought errors. Even now they are running around causing havoc. I'm not sure what to do about it.</p>
</main>



<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>
</html>
