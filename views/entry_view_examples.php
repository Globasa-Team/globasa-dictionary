<?
/**
  * Examples
  */
?>

<section class="examples">
<h2><?=sprintf($config->getTrans('Example'), "")?></h2>
<!-- <details> -->
    <!-- <summary> -->
<? for($i = 0; $i < min(2, count($entry['examples'])); $i++) : ?>
<blockquote>
<? if (is_array($entry['examples'][$i])) :?>
    <p><?=$entry['examples'][$i]['text']?></p>
    <? if(isset($entry['examples'][$i]['citation'])): ?><cite>&mdash; <?= $entry['examples'][$i]['citation']; ?></cite><? endif; ?>
<? else: // TODO: Remove  ?>
    <p><?= $entry['examples'][$i]; ?></p>
<? endif; ?>
</blockquote>
<? endfor; ?>
<!-- </summary> -->
<? if (false) : // DEBUG ?>
<? foreach($entry['examples'] as $example): ?>
<blockquote>
<? if (is_array($example)) :?>
    <p><?=$example['text']?></p>
    <? if(isset($example['citation'])): ?><cite>&mdash; <?= $example['citation']; ?></cite><? endif; ?>
<? else: // TODO: Remove  ?>
    <p><?=$example?></p>
<? endif; ?>
</blockquote>
<? endforeach; ?>
<? endif; // DEBUG ?>
<!-- </details> -->
</section>