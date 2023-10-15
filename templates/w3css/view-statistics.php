<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once("partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="content" class="w3-main">

<h1>Globasa Stats</h1>
<div class="flexy" style="display:flex; flex-direction: row; gap: 2em;">


<!--Lang count-->
<section style="">
<table class="w3-table-all" style="">
  <thead>
    <tr><th class="w3-right-align">Language</th><th class="w3-right-align">Words</th></tr>
  </thead>
<?php
foreach($stats['source langs'] as $lang=>$count) {?>
    <tr><td class="w3-right-align"><?=$lang?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</table>
</section>


<section style="display:flex; flex-direction: column; gap:2em;">


<p><?=$stats['terms count']?> dictionary entries</p>

<!--Word cat/class/soething-->
<table class="w3-table-all">
  <thead>
      <tr><th class="w3-right-align">Word class</th><th class="w3-right-align">Words</th></tr>
  </thead>
  <tbody>
<?php
foreach($stats['classes'] as $class=>$count) {?>
    <tr><td class="w3-right-align"><?=$class?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</tbody>
</table>


<!--testing delete-->
<table class="w3-table-all">
  <thead>
      <tr><th class="w3-right-align">Word Category</th><th class="w3-right-align">Words</th></tr>
  </thead>
  <tbody>
<?php
foreach($stats['categories'] as $name=>$count) {?>
    <tr><td class="w3-right-align"><?=$name?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</tbody>
</table>

</section>
</div> <!--/flexy-->

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
