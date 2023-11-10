<ul>
<? foreach($list as $item): ?>
    <li><a class="<?= $item_class; ?>" href="../lexi/<?=$item;?>"><?=$item;?></a></li>
<? endforeach; ?>
</ul>