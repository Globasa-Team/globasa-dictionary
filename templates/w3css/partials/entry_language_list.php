<ul class="lang_listx">
<?php
$lstart = true;
foreach($list as $lang=>$example):
    if (!$lstart) :
        ?>; <?
    endif;
    $lstart = false;
    
    ?>
    <li class="" style="display: inline"><span class="hl encap blue"><? echo($lang); ?></span><?
    if (!empty($example)):
        ?> <span class=""><?=$example?></span><?
    endif;
    ?></li><?
endforeach; ?>
</ul>