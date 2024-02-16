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
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi', $request, "Random Word"); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'abeceli-menalari', $request, 'Alphabetical Dictioary'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'natlang-abeceli', $request, 'Natlang Alphabetical'); ?></li>

        <li><?= WorldlangDictUtils::makeLink($config, 'lexilari', $request); ?>
            <br/>Vocab List / lexilari</li>
        <li><?= WorldlangDictUtils::makeLink($config, 'tul', $request); ?><ul>
            <li><?= WorldlangDictUtils::makeLink($config, 'tul/basatayti', $request); ?>
                <br/>Translation Aid</li>
            <li><?= WorldlangDictUtils::makeLink($config, 'tul/ifa-trasharufitul', $request); ?>
                <br/>IPA Converter</li>
            </ul></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'kandidato-lexi?candidate=', $request); ?>
            <br/>Candidate Word Check
            <ul>
                <li><?= WorldlangDictUtils::makeLink($config, 'samaeskri-lexi', $request); ?>
                    </br>Homonyms</li>
                <li><?= WorldlangDictUtils::makeLink($config, 'minimum-duaxey', $request); ?>
                    <br/>Minimum Pairs</li>
            </ul>
            </li>
        <li><?= WorldlangDictUtils::makeLink($config, 'estatisti-fe-lexiasel', $request); ?>
            <br/>Etymology Stats -- and unliked terms</li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports', $request, 'Reports'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports/changelog', $request, 'Changelog Report'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'reports/parse', $request, 'Parse Report'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'am-reporte', $request, '??? am-reporte'); ?></li>
        
        <li><?= WorldlangDictUtils::makeLink($config, 'estatisti', $request, 'Stats'); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'test', $request, 'Dev Dashboard'); ?></li>
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
        <!--
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        <li><?= WorldlangDictUtils::makeLink($config, 'lexi/', $request, ''); ?></li>
        -->
    </ul>
</section>


<section>
    <h2>Dev Report</h2>
    <pre>
<? include_once($config->api2Path.'reports/dev_report.yaml'); ?>
    </pre>
</hr>
    <pre>
<? include_once($config->api2Path.'reports/import_report.yaml'); ?>
    </pre>
</section>


</div><!--div.dashboard-->
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
