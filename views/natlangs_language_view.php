<?php

namespace WorldlangDict;

// TODO: i18n

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlangs_language">

<h1><?= sprintf($config->getTrans('natlangs language view title'), ucwords($arg)); ?></h1>

<dl>
<? foreach($data as $slug) { ?>
    <div>
    <? if (isset($dict[$slug])) : ?>
        <dt lang="<?= WL_CODE_FULL; ?>"><?=
            WorldlangDictUtils::makeLink(text:$dict[$slug]['term'],
                config:$config, request:$request,
                controller:'word', arg:urlencode($slug)
            );?>
        </dt>
        <dd>
        <? if (!empty($dict[$slug]['class'])) : ?>
            <span class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$dict[$slug]['class'];?></a>)</span>
        <? endif; ?>
            <?=$dict[$slug]['translation']?>
        </dd>
    <? else:
        error_log("Missing `{$slug}` from \$dict[] in `natlangs_language_view.php`."); ?>
        <dt lang="<?= WL_CODE_FULL; ?>"><?=$slug?></dt><dd></dd>
    <? endif; ?>
</div>


<? } ?>
</dl>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
