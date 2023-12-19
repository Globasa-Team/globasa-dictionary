<?php
namespace WorldlangDict;
header("HTTP/1.0 404 Not Found");
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once("partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>



<main>
  <h1>404: Page Not Found</h1>
</main>



<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>
</html>
