<?php
namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $page->title; ?></title>
  <meta name="description" content="<?php echo $page->description; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="<?php echo $config->siteUri; ?>globasa-logo.webp">
  <link rel="icon" type="image/png" href="<?php echo $config->siteUri; ?>globasa-logo.webp">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/globasa.css?3-02">
  <link href="https://fonts.googleapis.com/css?family=Literata|Merriweather&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <meta name="theme-color" content="#fafafa">
</head>

<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->




<div id="siteHeader">
    <h1 id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>">
            <span class="fa fa-book fa-lg"></span> <?php echo $config->siteName; ?>
        </a>
    </h1>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>"><?php echo $config->getTrans('random word button');?></a> &bull;
        <a href="https://xwexi.globasa.net/<?php echo $config->lang;?>/grammar/word-classes"><?php echo $config->getTrans('word classes link');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/translation-aide', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a>
    <form action="<?php echo WorldlangDictUtils::makeUri($config, "search", $request); ?>" method="get">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell">
            <input type="text" name="wTerm" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['wterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell">
            <input type="text" name="nTerm" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['nterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell w3-cell-middle">
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" class="w3-btn" />
        </div>
    </div>
    </form>


</div>



<div id="content" class="w3-main">
    <?php echo $page->content ?>
</div> <!-- id="w3-main" -->


<footer id="siteFooter" class="w3-container w3-padding-large w3-light-grey w3-opacity">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p>C0 <a href="https://www.globasa.net">Globasa.net</a>.<br/>
            A <a href="https://www.partialsolution.ca/">Partial Solution</a>.</p>
        </div>
        <div class="w3-container w3-cell w3-mobile" style="text-align: center;">
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'eng'); ?>">
                English</a> &bull;
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'spa'); ?>">
                español</a> &bull;
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'epo'); ?>">
                Esperanto</a>
<?php /* Remove I just don't want to delete it.
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'fra'); ?>">
                français</a> &bull;
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'glb'); ?>">
                Globasa</a> &bull;
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'rus'); ?>">
                русский</a> &bull;
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'zho'); ?>">
                中文</a>
*/ ?>
        </div>

        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p><a href="https://www.globasa.net/" class="w3-button"><span class="fa fa-link"></span> <?php echo $config->getTrans('globasa link');?></a><br/>
            <a href="https://github.com/ShawnPConroy/WorldlangDict" class="w3-button"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a><br/>
            <a href="<?php echo WorldlangDictUtils::makeUri(
    $config,
    'am-reporte/?url='.$config->siteUri.substr($request->url, 1),
    $request
); ?>" class="w3-button"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a><br/>
            <a href="https://api.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a></p>
        </div>
    </div>
</footer>

  <script src="<?php echo $config->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="<?php echo $config->templateUri; ?>js/plugins.js"></script>
  <script src="<?php echo $config->templateUri; ?>js/main.js"></script>

</body>

</html>
