<?php
namespace WorldlangDict;
?>
<!doctype html>
<html lang="">
<? require_once("partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>


<main id="content" class="w3-main w3-container">

    <h1><?= $config->getTrans('browse title') ?></h1>

    <div class="w3-card">
        <header class="w3-container w3-black">
            <h2><?= $config->getTrans('browse filters header') ?></h2>
        </header>
        <section class="w3-container w3-blue filter">
            <h3><?= $config->getTrans('browse filter by letter header') ?></h3>
            <div class="w3-bar">
            <?php foreach (range('a', 'z') as $char) {
                echo "<input type=\"radio\" name=\"letter\" id=\"letter-{$char}\" value=\"{$char}\">
                <label for=\"letter-{$char}\" class=\"w3-bar-item w3-button\">{$char}</label>";
            } ?>
            </div>
        </section>

        <section class="w3-container w3-green filter">
            <h3 class=""><?= $config->getTrans('browse filter by category header') ?></h3>
            <div class="w3-bar ">
                <input id="cat-affix" type="radio" name="category" value="affix">
                <label for="cat-affix" class="w3-bar-item w3-button"><?= $config->getTrans('affix') ?></label>
                <input id="cat-root" type="radio" name="category" value="root">
                <label for="cat-root" class="w3-bar-item w3-button"><?= $config->getTrans('root') ?></label>
                <input id="cat-derived" type="radio" name="category" value="derived">
                <label for="cat-derived" class="w3-bar-item w3-button"><?= $config->getTrans('derived word') ?></label>
                <input id="cat-all" type="radio" name="category" value="all">
                <label for="cat-all" class="w3-bar-item w3-button"><?= $config->getTrans('category all') ?></label>
            </div>
        </section>
    </div>


    <?php echo $page->content ?>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
