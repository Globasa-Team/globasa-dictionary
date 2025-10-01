<?

namespace WorldlangDict;


?>
<table class="lang_list">
<?
$lstart = true;
foreach($list as $lang=>$example):
?>
    <tr><th><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:"natlang", arg:$lang, request:$request); ?>" class=""><?= $lang; ?></a></th>
    <td><span><?=$example?></span></td></tr>
<?php
endforeach;
?>
</table>
