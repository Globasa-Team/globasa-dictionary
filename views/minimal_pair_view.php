<?php

declare(strict_types=1);

namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>

<body>

<?php require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="minimal_pairs">
<?php require('views/minimal_pair_view_part.php'); ?>
</main>

<?php require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>