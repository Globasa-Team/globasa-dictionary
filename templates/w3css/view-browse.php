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


<div id="content" class="w3-main w3-container">


<!--
Menu: Browse Dictionary
URL: /kentanible-menalari
-->


<div class="w3-card" style1="display:none;">
    <header class="w3-container w3-black">
        <h2>Filters</h2>
    </header>
    <section class="w3-container w3-blue">
        <h3 class=" ">By Letter</h3>
        <div class="w3-bar">
        <?php foreach (range('a', 'z') as $char) {
            echo "<input type=\"radio\" name=\"letter\" id=\"letter-{$char}\" value=\"{$char}\" style=\"display:none;\">
            <label for=\"letter-{$char}\" class=\"w3-bar-item w3-button\" style=\"width: 7.5%\">{$char}</label>";
        } ?>
        </div>
    </section>

    <section class="w3-container w3-green">
        <h3 class="">By type</h3>
        <div class="w3-bar ">
            <input type="radio" name="category" style="display:none;" id="affixes" value="affixes">
            <label for="affixes" class="w3-bar-item w3-button" style="width:25%;">affixes</label>
            <input type="radio" name="category" style="display:none;" id="root" value="root">
            <label for="root" class="w3-bar-item w3-button" style="width:25%;">root words</label>
            <input type="radio" name="category" style="display:none;" id="derived" value="derived">
            <label for="derived" class="w3-bar-item w3-button" style="width:25%;">derived words</label>
            <input type="radio" name="category" style="display:none;" id="all" value="all">
            <label for="all" class="w3-bar-item w3-button" style="width:25%;">all</label>
        </div>
    </section>
</div>







    <?php echo $page->content ?>
</div> <!-- id="w3-main" -->


<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
