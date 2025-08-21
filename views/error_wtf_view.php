<?php
namespace WorldlangDict;
http_response_code(500);
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang ?? ''; ?>">
<?php
if (isset($config->templatePath)) :
    include_once($config->templatePath . "partials/html-head.php");
    echo("<body>\n");
    include_once($config->templatePath . "partials/page-header.php");
else: ?>
    <head>
        <meta charset="utf-8">
        <title><?= isset($page->title) ?? "500: Globasa"; ?></title>
    </head>
<?php endif; ?>

<main>
    <h1>Server Error</h1>
    <p>Processing your request resulted in uncaught errors. Even now they are running around causing havoc. I'm not sure what to do about it.</p>
    <p>However, I did write about it in the system error log.</p>
</main>

<?php
if (isset($config) && isset($config->templatePath)) :
    include_once($config->templatePath . "partials/page-footer.php");
endif;
?>

</body>
</html>