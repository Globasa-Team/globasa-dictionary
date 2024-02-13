<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main class="dev_dashboard">
<h1>Dev Dashboard</h1>
<div class="dashboard">

<section>
    <h2>Website Features</h2>
    <ul>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'abeceli-menalari', $request); ?>
            <br/>Browse / </li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexilari', $request, 'Tags'); ?>
            <br/>Vocab List / lexilari</li>
        <li><?= WorldlangDictUtils::makeLink($config, 'tul', $request); ?><ul>
            <li><?= WorldlangDictUtils::makeLink($config, 'tul/basatayti', $request); ?></li>
            <li><?= WorldlangDictUtils::makeLink($config, 'tul/ifa-trasharufitul', $request); ?></li>
            </ul></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'samaeskri-lexi', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'minimum-duaxey', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'kandidato-lexi?candidate=', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'estatisti-fe-lexiasel', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports/changelog', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports/parse', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'am-reporte', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'natlang-abeceli', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'estatisti', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports', $request); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'test', $request); ?></li>
    </ul>
</section>


<section>
    <h2>Words</h2>
    <ul>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/bwaw', $request, 'bwaw'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/ente', $request, 'ente'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/haul', $request, 'haul'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/denwatu+hu', $request, 'denwatu+hu'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/hataya', $request, 'hataya'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/ku', $request, 'ku'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/murto', $request, 'murto'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/basatayti', $request, 'basatayti'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
    </ul>
</section>

</div><!--div.dashboard-->
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
