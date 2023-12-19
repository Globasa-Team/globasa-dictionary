<?php namespace WorldlangDict; ?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="features">

<h1><?=$config->getTrans('tools button');?></h1>


<section>
    <header>
        <h2><a href="<?=WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request);?>"><?=$config->getTrans('translation aide title');?></a></h2>
    </header>
    <p><?=$config->getTrans('translation aide description');?></p>
</section>


<section>
    <header>
        <h2><a href="<?=WorldlangDictUtils::makeUri($config, 'tul/ifa-trasharufitul', $request);?>"><?=$config->getTrans('ipa converter title');?></a></h2>
    </header>
    <p><?=$config->getTrans('ipa converter description');?></p>
</section>


<section>
    <header>
        <h2><?=$config->getTrans('candidate check title');?></h2>
    </header>
    <form class="tool" action="<?=WorldlangDictUtils::makeUri($config, "tul/kandidato-lexi", $request);?>" method="get">
        <input type="text" name="candidate" placeholder="<?=$config->getTrans('candidate check placeholder');?>" />
        <input type="submit" value="<?=$config->getTrans('candidate check button');?>" />
    </form>
    <p><?=$config->getTrans('candidate check description');?></p>
</section>

<section>
    <header>
        <h2><a href="<?=WorldlangDictUtils::makeUri($config, 'tul/samaeskri-lexi', $request);?>"><?=$config->getTrans('homonym terminator title');?></a></h2>
    </header>
    <p><?=$config->getTrans('homonym terminator description');?></p>
</section>

<section>
    <header>
        <h2><a href="<?=WorldlangDictUtils::makeUri($config, 'tul/minimum-duaxey', $request);?>"><?=$config->getTrans('minimum pair title');?></a></h2>
    </header>
    <p><?=$config->getTrans('minimum pair description');?></p>
</section>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
