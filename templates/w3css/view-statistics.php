<?php
namespace WorldlangDict;






const VALID_WORD_CLASSES = array (

  // Content Words
  'f',
      'f.lin',
      'f.oj',
      'f.nenoj',
      'f.oro',
          'f.oro.a',
          'f.oro.b',
      'f.sah',
  'm',
  'n',
      'pn',
          'su pn',
      'su n',
  's',
      'su s',
  't',
  // Function Words
  'd',
  'il',
  'l',
  'num',
  'par',
  'p',
      'lp',
      'xp',
  // Affixes
  'fik',
      'lfik',
      'xfik',
  // Phrases
  'jm',
      'p jm',
      'jm p',
      'f jm'
);


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
    <tr class="w3-red"><th class="w3-right-align">Language</th><th class="w3-right-align">Words</th></tr>
  </thead>
<?php
foreach($stats['source langs'] as $lang=>$count) {?>
    <tr><td class="w3-right-align"><?=$lang?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</table>
</section>


<section style="display:flex; flex-direction: column; gap:2em;">


<p><?=$stats['terms count']?> dictionary entries</p>


<?php
function showClassCount($stats, $class) {
  if (isset($stats['classes'][$class]))
    return($stats['classes'][$class]);
  else
    return('?');
}

function showClassPercent($stats, $class) {
  if (isset($stats['classes'][$class]))
    return(floor($stats['classes'][$class]/$stats['terms count']*100).'%');
  else
    return('?');
}

?>

<table class="w3-table-all">
  <thead><tr class="w3-yellow"><th>Class</th><th>Count</th><th>%</th></tr></thead>
  <tbody>

  <tr class="w3-pale-yellow"><th colspan="3">Content Words</th></tr>
    <tr><th>f</th><td class="w3-right-align"><?=showClassCount($stats,'f')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f')?></td></tr>
    <tr><th>↳ f.lin</th><td class="w3-right-align"><?=showClassCount($stats,'f.lin')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.lin')?></td></tr>
    <tr><th>↳ f.oj</th><td class="w3-right-align"><?=showClassCount($stats,'f.oj')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.oj')?></td></tr>
    <tr><th>↳ f.nenoj</th><td class="w3-right-align"><?=showClassCount($stats,'f.nenoj')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.nenoj')?></td></tr>
    <tr><th>↳ f.oro</th><td class="w3-right-align"><?=showClassCount($stats,'f.oro')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.oro')?></td></tr>
    <tr><th>&nbsp; ⇒ f.oro.a</th><td class="w3-right-align"><?=showClassCount($stats,'f.oro.a')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.oro.a')?></td></tr>
    <tr><th>&nbsp; ⇒ f.oro.b</th><td class="w3-right-align"><?=showClassCount($stats,'f.oro.b')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.oro.b')?></td></tr>
    <tr><th>↳ f.sah</th><td class="w3-right-align"><?=showClassCount($stats,'f.sah')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f.sah')?></td></tr>
    <tr><th>m</th><td class="w3-right-align"><?=showClassCount($stats,'m')?></td><td class="w3-right-align"><?=showClassPercent($stats,'m')?></td></tr>
    <tr><th>n</th><td class="w3-right-align"><?=showClassCount($stats,'n')?></td><td class="w3-right-align"><?=showClassPercent($stats,'n')?></td></tr>
    <tr><th>↳ pn</th><td class="w3-right-align"><?=showClassCount($stats,'pn')?></td><td class="w3-right-align"><?=showClassPercent($stats,'pn')?></td></tr>
    <tr><th>&nbsp; ⇒ su pn</th><td class="w3-right-align"><?=showClassCount($stats,'su pn')?></td><td class="w3-right-align"><?=showClassPercent($stats,'su pn')?></td></tr>
    <tr><th>↳ su n</th><td class="w3-right-align"><?=showClassCount($stats,'su n')?></td><td class="w3-right-align"><?=showClassPercent($stats,'su n')?></td></tr>
    <tr><th>s</th><td class="w3-right-align"><?=showClassCount($stats,'s')?></td><td class="w3-right-align"><?=showClassPercent($stats,'s')?></td></tr>
    <tr><th>↳ su s</th><td class="w3-right-align"><?=showClassCount($stats,'su s')?></td><td class="w3-right-align"><?=showClassPercent($stats,'su s')?></td></tr>
    <tr><th>t</th><td class="w3-right-align"><?=showClassCount($stats,'t')?></td><td class="w3-right-align"><?=showClassPercent($stats,'t')?></td></tr>
    <tr class="w3-pale-yellow"><th colspan="3">Function Words</th></tr>
    <tr><th>d</th><td class="w3-right-align"><?=showClassCount($stats,'d')?></td><td class="w3-right-align"><?=showClassPercent($stats,'d')?></td></tr>
    <tr><th>il</th><td class="w3-right-align"><?=showClassCount($stats,'il')?></td><td class="w3-right-align"><?=showClassPercent($stats,'il')?></td></tr>
    <tr><th>l</th><td class="w3-right-align"><?=showClassCount($stats,'l')?></td><td class="w3-right-align"><?=showClassPercent($stats,'l')?></td></tr>
    <tr><th>num</th><td class="w3-right-align"><?=showClassCount($stats,'num')?></td><td class="w3-right-align"><?=showClassPercent($stats,'num')?></td></tr>
    <tr><th>par</th><td class="w3-right-align"><?=showClassCount($stats,'par')?></td><td class="w3-right-align"><?=showClassPercent($stats,'par')?></td></tr>
    <tr><th>p</th><td class="w3-right-align"><?=showClassCount($stats,'p')?></td><td class="w3-right-align"><?=showClassPercent($stats,'p')?></td></tr>
    <tr><th>↳ lp</th><td class="w3-right-align"><?=showClassCount($stats,'lp')?></td><td class="w3-right-align"><?=showClassPercent($stats,'lp')?></td></tr>
    <tr><th>↳ xp</th><td class="w3-right-align"><?=showClassCount($stats,'xp')?></td><td class="w3-right-align"><?=showClassPercent($stats,'xp')?></td></tr>
    <tr class="w3-pale-yellow"><th colspan="3">Affixes</th></tr>
    <tr><th>fik</th><td class="w3-right-align"><?=showClassCount($stats,'fik')?></td><td class="w3-right-align"><?=showClassPercent($stats,'fik')?></td></tr>
    <tr><th>↳ lfik</th><td class="w3-right-align"><?=showClassCount($stats,'lfik')?></td><td class="w3-right-align"><?=showClassPercent($stats,'lfik')?></td></tr>
    <tr><th>↳ xfik</th><td class="w3-right-align"><?=showClassCount($stats,'xfik')?></td><td class="w3-right-align"><?=showClassPercent($stats,'xfik')?></td></tr>
    <tr class="w3-pale-yellow"><th colspan="3">Phrases</th></tr>
    <tr><th>jm</th><td class="w3-right-align"><?=showClassCount($stats,'jm')?></td><td class="w3-right-align"><?=showClassPercent($stats,'jm')?></td></tr>
    <tr><th>↳ p jm</th><td class="w3-right-align"><?=showClassCount($stats,'p jm')?></td><td class="w3-right-align"><?=showClassPercent($stats,'p jm')?></td></tr>
    <tr><th>↳ jm p</th><td class="w3-right-align"><?=showClassCount($stats,'jm p')?></td><td class="w3-right-align"><?=showClassPercent($stats,'jm p')?></td></tr>
    <tr><th>↳ f jm</th><td class="w3-right-align"><?=showClassCount($stats,'f jm')?></td><td class="w3-right-align"><?=showClassPercent($stats,'f jm')?></td></tr>
  </tbody>


<tbody>
  <tr class="w3-red"><th colspan="3">Errors--invalid classes</th></tr>
<?foreach($stats['classes'] as $class=>$count) {
    if(in_array($class, VALID_WORD_CLASSES)) continue;?>
    <tr class="w3-pale-red"><td class="w3-right-align"><?=$class?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</tbody>




</table>



<!--Word class (verb etc)-->
<table class="w3-table-all">
  <thead>
    <tr class="w3-orange"><th class="w3-right-align">Word class</th><th class="w3-right-align">Words</th></tr>
  </thead>
  <tbody>
<?php
foreach($stats['classes'] as $class=>$count) {?>
    <tr><td class="w3-right-align"><?=$class?></td><td class="w3-right-align"><?=$count?></td></tr>
<?}?>
</tbody>
</table>


<!--Word categoy (affix, etc)-->
<table class="w3-table-all">
  <thead>
    <tr class="w3-red"><th class="w3-right-align">Word Category</th><th class="w3-right-align">Words</th></tr>
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
