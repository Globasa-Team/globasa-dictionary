<?php
/**
  * Examples
  */

if ($examples) :
?>
    <section class="examples">
    <h2><?=sprintf($config->getTrans('Example'), "")?></h2>
    <details><summary>
<?php
    for($i=0; $i<ENTRY_EXAMPLES_SHOW; $i++) :
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
    if (count($examples) > 0) :
?>
        <div class="expand_icon"><span class="hl h1 expand_icon">[+]</span></div>
<?php
    endif;
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