<?php

declare(strict_types=1);

namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<?php require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<?php
require_once($config->templatePath . "partials/page-header.php");
?>

<main class="homonyms">
<?php require('views/homonym_view_part.php'); ?> 
</main>

<?php require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
