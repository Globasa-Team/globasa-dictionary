<?php
/**
  * Examples
  */

if ($examples) :
?>
    <section class="examples">
    <details><summary>
        <h2><?=sprintf($config->getTrans('Example'), "")?></h2>
<?php
    if (count($examples) > 0) print('<span class="expand_icon">[+]</span><span class="collapse_icon">[-]</span>');
    for($i=0; $i<ENTRY_EXAMPLES_SHOW; $i++) :
        $example = array_shift($examples);
        if ($example === null) break;
?>
        <blockquote>
            <p><?=$example['text']?>
            </p>
            <?php if(isset($example['link'])) : ?><cite>&mdash; <a href="<?= $example['link']; ?>"><?= $example['cite']; ?></a></cite>
            <?php elseif(isset($example['cite'])) : ?><cite>&mdash; <?= $example['cite']; ?></cite><? endif; ?>
        </blockquote>
<?php
    endfor;
?>
    </summary>
    
<?php
    for($i=ENTRY_EXAMPLES_SHOW; $i<ENTRY_EXAMPLES_MAX; $i++) :
        $example = array_shift($examples);
        if ($example === null) break;
?>
        <blockquote>
            <p><?=$example['text']?></p>
            <?php if(isset($example['link'])) : ?><cite>&mdash; <a href="<?= $example['link']; ?>"><?= $example['cite']; ?></a></cite>
            <?php elseif(isset($example['cite'])) : ?><cite>&mdash; <?= $example['cite']; ?></cite><? endif; ?>
        </blockquote>
<?php
    endfor;
?>

</details>
</section>
<?php
endif; /* file exists */