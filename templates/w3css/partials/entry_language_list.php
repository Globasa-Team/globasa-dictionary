<ul>
<?php foreach($list as $lang=>$example): ?>
    <li style="display:inline-block; margin: 2px;"><span class="w3-tag w3-round w3-dark-grey" style="padding:3px;"><? echo($lang);
    if (!empty($example)):
        ?> <span class="w3-tag w3-round w3-light-grey"><?=$example?></span><?
    endif;
    ?></span></li><?
endforeach; ?>
</ul>