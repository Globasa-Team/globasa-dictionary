<?php
namespace WorldlangDict;
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $page->title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/globasa.css">
  <link href="https://fonts.googleapis.com/css?family=Literata|Merriweather&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <meta name="theme-color" content="#fafafa">
</head>

<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


<div class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-collapse" style="display:none;right:0;top:50px;" id="sidebar">
    <!--<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>-->
  
    <form action="<?php echo WorldlangDictUtils::makeUri($config, "search"); ?>" method="get">
        <input type="text" name="wTerm" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" class="w3-input w3-border" />
        <input type="text" name="nTerm" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" class="w3-input w3-border" />
        <input type="submit" value="<?php echo $config->getTrans('search button');?>" class="w3-btn w3-blue" />
    </form>
    <hr />
    <a href="<?php echo WorldlangDictUtils::makeUri($config, ''); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> <?php echo $config->getTrans('random word button');?></a>
    <a href="<?php echo WorldlangDictUtils::makeUri($config, 'leksilar'); ?>" class="w3-bar-item w3-button"><span class="fa fa-list"></span> <?php echo $config->getTrans('all words button');?></a>
    <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tule'); ?>" class="w3-bar-item w3-button"><span class="fa fa-briefcase"></span> <?php echo $config->getTrans('tools button');?></a>
    <div class="w3-dropdown-click">
        <button class="w3-button" onclick="toggleAccordian(languageMenu)"><span class="fa fa-language"></span> <?php echo $config->getTrans('language button');?></button>
        <div id="languageMenu" class="w3-dropdown-content w3-bar-block w3-blue">
            <p>Currently only English language translations and interface is complete.</p>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'eng'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> English</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'epo'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> Esperanto</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'fra'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> français</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'glb'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> globasa</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'spa'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> español</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'rus'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> русский</a>
            <a href="<?php echo WorldlangDictUtils::changeLangUri($config, $request, 'zho'); ?>" class="w3-bar-item w3-button">
                <span class="fa fa-random"></span> 中文</a>
        </div>
    </div>
    <div class="w3-dropdown-click">
        <button class="w3-button" onclick="toggleAccordian(moreMenu)"><span class="fa fa-ellipsis-h"></span> <?php echo $config->getTrans('more button');?></button>
        <div id="moreMenu" class="w3-dropdown-content w3-bar-block w3-blue">
            <a href="http://www.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-link"></span> <?php echo $config->getTrans('globasa link');?></a>
            <a href="https://github.com/ShawnPConroy/WorldlangDict" class="w3-bar-item w3-button"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a>
            <a href="" class="w3-bar-item w3-button"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a>
            <a href="http://api.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a>
            <hr />
            C0 <a href="http://www.globasa.net">Globasa.net</a>. A <a href="http://www.partialsolution.ca/">Partial Solution</a>.
        </div>
    </div>
    
</div>

<div id="siteHeader" class="w3-pale-blue">
  <div class="w3-container">
    <button id="openNav" class="w3-button w3-pale-blue w3-xlarge w3-right" onclick="w3_open()">&#9776;</button>
    <h1 id="appTitle" style="display: inline-block;"><span class="fa fa-book fa-lg"></span> <?php echo $config->siteName; ?></h1>
  </div>
</div>

<div id="main">

<div id="content">
    <?php echo $page->content ?>
</div>

</div> <!-- id="main" -->

<script>
function w3_open() {
//   document.getElementById("main").style.marginLeft = "200px";
  document.getElementById("sidebar").style.width = "200px";
  document.getElementById("sidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
//   document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("sidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}

function toggleAccordian(submenuId) {
    if (submenuId.className.indexOf("w3-show") == -1) {
        submenuId.className += " w3-show";
        submenuId.previousElementSibling.className += " w3-grey";
    } else { 
        submenuId.className = submenuId.className.replace(" w3-show", "");
        submenuId.previousElementSibling.className = 
        submenuId.previousElementSibling.className.replace(" w3-green", "");
    }
    
}

</script>

  <script src="<?php echo $app->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="<?php echo $app->templateUri; ?>js/plugins.js"></script>
  <script src="<?php echo $app->templateUri; ?>js/main.js"></script>

</body>

</html>
