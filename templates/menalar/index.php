<?php
namespace WorldlangDict;?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $app->page->title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/globasa.css">
  <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
  
    <form action="<?php /* echo WorldlangDictUtils::makeUri($app, "search"); */ ?>" method="get">
        <input type="text" name="term" placeholder="<?php echo $app->getTrans('Search Placeholder');?>" class="w3-input w3-border" />
        <input type="submit" name="gSearch" value="Globasa Search" class="w3-btn w3-blue" />
        <input type="submit" name="lSearch" value="English Search" class="w3-btn w3-blue" />
    </form>
    <hr />
    <a href="<?php echo WorldlangDictUtils::makeUri($app, ''); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> Random Word</a>
    <a href="<?php echo WorldlangDictUtils::makeUri($app, 'menalar'); ?>" class="w3-bar-item w3-button"><span class="fa fa-list"></span> All Words</a>
    <a href="<?php echo WorldlangDictUtils::makeUri($app, 'tule'); ?>" class="w3-bar-item w3-button"><span class="fa fa-briefcase"></span> Tools</a>
    <div class="w3-dropdown-hover">
        <button class="w3-button"><span class="fa fa-language"></span> Language</button>
        <div class="w3-dropdown-content w3-bar-block">
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'eng'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> English</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'epo'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> Esperanto</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'fra'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> français</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'glb'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> globasa</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'spa'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> español</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'rus'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> русский</a>
            <a href="<?php echo WorldlangDictUtils::makeUri($app, 'zho'); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> 中文</a>
        </div>
    </div>
    <div class="w3-dropdown-hover">
        <button class="w3-button"><span class="fa fa-ellipsis-h"></span> More</button>
        <div class="w3-dropdown-content w3-bar-block">
            <a href="http://www.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-link"></span> Globasa</a>
            <a href="https://github.com/ShawnPConroy/WorldlangDict" class="w3-bar-item w3-button"><span class="fa fa-github"></span> GitHub</a>
            <a href="" class="w3-bar-item w3-button"><span class="fa fa-bug"></span> Report a problem (coming soon)</a>
            <a href="http://api.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-code"></span> API</a>
            <hr />
            C0 <a href="http://www.globasa.net">Globasa.net</a>. A <a href="http://www.partialsolution.ca/">Partial Solution</a>.
        </div>
    </div>

</div>

<div id="main">

<div class="w3-teal">
  <div class="w3-container">
    <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
    <h1 style="display: inline-block;"><span class="fa fa-book fa-lg"></span> Leksi <?php /* echo $app->getTrans('App Name'); */ ?></h1>
  </div>
</div>

<div style="max-width: 600px; margin: auto auto; min-margin: 5px;">
<div class="w3-card">
    
    <?php echo $app->page->content ?>
</div>
</div>


</div>

</div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "200px";
  document.getElementById("mySidebar").style.width = "200px";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

</body>

</html>
