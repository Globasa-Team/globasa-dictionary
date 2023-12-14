<ul class="lang_list">
<?php foreach($list as $lang=>$example): ?>
    <li class="hl"><? echo($lang);
    if (!empty($example)):
        ?> <span class="hl"><?=$example?></span><?
    endif;
    ?></li><?
endforeach; ?>
</ul>