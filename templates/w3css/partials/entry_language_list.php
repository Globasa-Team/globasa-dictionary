<?

namespace WorldlangDict;


?>
<ul class="lang_list">
<?php
$lstart = true;
foreach($list as $lang=>$example): ?>
    <li><a href="<?= WorldlangDictUtils::makeUri($config, "estatisti-fe-lexiasel/".$lang, $request); ?>" class="hl encap"><?= $lang; ?></a><?
    if (!empty($example)):
        ?> <span><?=$example?></span><?
    endif;
    ?></li><?
endforeach; ?>
</ul>