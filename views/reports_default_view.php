<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="features">

<h1><?=$config->getTrans('tools button');?></h1>


<section>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'parse', request:$request);?>"><?=$config->getTrans('report parse title');?></a></h2>
        <p><?=$config->getTrans('report parse description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'new-terms', request:$request);?>"><?=$config->getTrans('report parse title');?></a></h2>
        <p><?=$config->getTrans('report parse description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'updated-entries', request:$request);?>"><?=$config->getTrans('report parse title');?></a></h2>
        <p><?=$config->getTrans('report parse description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'removed-terms', request:$request);?>"><?=$config->getTrans('report parse title');?></a></h2>
        <p><?=$config->getTrans('report parse description');?></p>
    </div>
</section>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
