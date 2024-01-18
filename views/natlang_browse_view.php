<?php

namespace WorldlangDict;

// TODO: i18n
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="natlang_browse">

<h1><?=$config->getTrans('natlang browser title');?></h1>


<dl>
<? foreach($index as $term=>$data) :
$first = true;
//   if (!in_array($natlang, OFFICIAL_NATLANGS)) {
//     continue;  
//   }
    ?>
    <div><dt><?= $term; ?>:</dt><dd> <? foreach($data as $trans) :
    if (!$first) {
        echo ", ";
    }
    echo WorldlangDictUtils::makeLink($config, "lexi/".$trans, $request, $trans);
    $first = false;
    endforeach; ?></dd></div>
<? endforeach; ?>
</dl>



</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
