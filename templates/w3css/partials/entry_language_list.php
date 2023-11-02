<ul>
<?php foreach($list as $lang=>$example): ?>
    <li><span class="w3-tag w3-round w3-dark-grey"><? echo($lang);
    if (!empty($example)):
        ?> <span class="w3-tag w3-round w3-light-grey"><?=$example?></span><?
    endif;
    ?></span></li><?
endforeach; ?>
</ul>