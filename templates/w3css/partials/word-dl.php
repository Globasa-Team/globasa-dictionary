<? namespace WorldlangDict; ?>
<dl class="dictionaryList tags_extended">
<?php
foreach($list as $termIndex=>$term):
    if (!isset($config->dictionary->words[$termIndex])) continue;
    $word = $config->dictionary->words[$termIndex];
    
    $letter = ctype_alpha($word->termIndex[0]) ? $word->termIndex[0] : $word->termIndex[1];
    ?>
    <dt data-class="<?= $word->wordClass; ?>" data-category="<?= $word->category; ?>" data-char="<?= $letter; ?>"><?= WorldlangDictUtils::makeLink(
            $config,
            'lexi/'.urlencode($word->term),
            $request,
            $word->term
        ); ?></dt>
    <dd data-class="<?= $word->wordClass; ?>" data-category="<?= $word->category; ?>" data-char="<?= $letter; ?>"><?= $word->translation[$config->lang] ?>
</dd>
<? endforeach; ?>
</dl>