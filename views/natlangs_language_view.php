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
<? foreach($data as $term) { ?>

    <div>
        <dt lang="<?= GLB_CODE; ?>"><?=
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($term),
                $request,
                $term
            );?>
<? if (isset($dict[$term]['class']) && !empty($dict[$term]['class'])) : ?>
            
<? endif; ?>
        </dt>
        <dd>
            <span class="wordClass">(<?=$dict[$term]['class'];?>)</span>
            <?=$dict[$term]['translation']?>
        </dd>
    </div>


<? } ?>
</dl>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
