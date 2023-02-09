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
        <header class="w3-container">
            <h2><?= $config->getTrans('browse filters header') ?></h2>
        </header>
        <section class="w3-container filter">
            <h3><?= $config->getTrans('browse filter by letter header') ?></h3>
            <div class="w3-bar">
                <!-- <input type="radio" name="letter" id="letter-#" value="#">
                <label for="letter-#" class="w3-bar-item w3-button">#</label> -->
                <input type="radio" name="letter" id="letter-a" value="a">
                <label for="letter-a" class="w3-bar-item w3-button">a</label>
                <input type="radio" name="letter" id="letter-b" value="b">
                <label for="letter-b" class="w3-bar-item w3-button">b</label>
                <input type="radio" name="letter" id="letter-c" value="c">
                <label for="letter-c" class="w3-bar-item w3-button">c</label>
                <input type="radio" name="letter" id="letter-d" value="d">
                <label for="letter-d" class="w3-bar-item w3-button">d</label>
                <input type="radio" name="letter" id="letter-e" value="e">
                <label for="letter-e" class="w3-bar-item w3-button">e</label>
                <input type="radio" name="letter" id="letter-f" value="f">
                <label for="letter-f" class="w3-bar-item w3-button">f</label>
                <input type="radio" name="letter" id="letter-g" value="g">
                <label for="letter-g" class="w3-bar-item w3-button">g</label>
                <input type="radio" name="letter" id="letter-h" value="h">
                <label for="letter-h" class="w3-bar-item w3-button">h</label>
                <input type="radio" name="letter" id="letter-i" value="i">
                <label for="letter-i" class="w3-bar-item w3-button">i</label>
                <input type="radio" name="letter" id="letter-j" value="j">
                <label for="letter-j" class="w3-bar-item w3-button">j</label>
                <input type="radio" name="letter" id="letter-k" value="k">
                <label for="letter-k" class="w3-bar-item w3-button">k</label>
                <input type="radio" name="letter" id="letter-l" value="l">
                <label for="letter-l" class="w3-bar-item w3-button">l</label>
                <input type="radio" name="letter" id="letter-m" value="m">
                <label for="letter-m" class="w3-bar-item w3-button">m</label>
                <input type="radio" name="letter" id="letter-n" value="n">
                <label for="letter-n" class="w3-bar-item w3-button">n</label>
                <input type="radio" name="letter" id="letter-o" value="o">
                <label for="letter-o" class="w3-bar-item w3-button">o</label>
                <input type="radio" name="letter" id="letter-p" value="p">
                <label for="letter-p" class="w3-bar-item w3-button">p</label>
                <input type="radio" name="letter" id="letter-r" value="r">
                <label for="letter-r" class="w3-bar-item w3-button">r</label>
                <input type="radio" name="letter" id="letter-s" value="s">
                <label for="letter-s" class="w3-bar-item w3-button">s</label>
                <input type="radio" name="letter" id="letter-t" value="t">
                <label for="letter-t" class="w3-bar-item w3-button">t</label>
                <input type="radio" name="letter" id="letter-u" value="u">
                <label for="letter-u" class="w3-bar-item w3-button">u</label>
                <input type="radio" name="letter" id="letter-v" value="v">
                <label for="letter-v" class="w3-bar-item w3-button">v</label>
                <input type="radio" name="letter" id="letter-w" value="w">
                <label for="letter-w" class="w3-bar-item w3-button">w</label>
                <input type="radio" name="letter" id="letter-x" value="x">
                <label for="letter-x" class="w3-bar-item w3-button">x</label>
                <input type="radio" name="letter" id="letter-y" value="y">
                <label for="letter-y" class="w3-bar-item w3-button">y</label>
                <input type="radio" name="letter" id="letter-z" value="z">
                <label for="letter-z" class="w3-bar-item w3-button">z</label>
                <!-- <input type="radio" name="letter" id="letter-all" value="all">
                <label for="letter-all" class="w3-bar-item w3-button">all</label> -->
            </div>
        </section>

        <section class="w3-container filter">
            <h3 class=""><?= $config->getTrans('browse filter by category header') ?></h3>
            <div class="w3-bar">
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
