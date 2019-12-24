<?php
namespace WorldlangDict;?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $app->page->title; ?>Menalar</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/globasa.css">
  <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans|Arimo|Public+Sans|Libre+Franklin|Philosopher|Proza+Libre|Public+Sans|Rosario|Sarabun|Source+Sans+Pro|Amiri|Crimson+Pro|GFS+Neohellenic|Literata|Livvic|Merriweather|Muli|Overlock|Sansita|Spectral|Volkhov|Imprima&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <meta name="theme-color" content="#fafafa">
</head>

<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
  
    <form action="<?php echo WorldlangDictUtils::makeUri($app, "search"); ?>" method="get">
        <input type="text" name="term" placeholder="<?php echo $app->getTrans('Search Placeholder');?>" class="w3-input w3-border" />
        <input type="submit" name="gSearch" value="Globasa Search" class="w3-btn w3-blue" />
        <input type="submit" name="lSearch" value="English Search" class="w3-btn w3-blue" />
    </form>
    <hr />
    <a href="<?php echo WorldlangDictUtils::makeUri($app, ''); ?>" class="w3-bar-item w3-button"><span class="fa fa-random"></span> Random Word</a>
    <a href="<?php echo WorldlangDictUtils::makeUri($app, 'leksilar'); ?>" class="w3-bar-item w3-button"><span class="fa fa-list"></span> All Words</a>
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
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Libre Franklin')">sans: Libre Franklin</button>
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Sarabun')">sans: Sarabun</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Alegreya Sans')">sans: Alegreya Sans</button>-->
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Source Sans Pro')">sans: Source Sans Pro</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Public Sans')">sans: Public Sans</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Proza Libre')">sans: Proza Libre (G)</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Rosario')">sans: Rosario</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Arimo')">sans: Arimo</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Philosopher')">sans: Philosopher</button>
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Amiri')">serif: Amiri</button>-->
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Crimson Pro')">serif: Crimson Pro</button>
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('GFS Neohellenic')">serif: GFS+Neohellenic</button>-->
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Literata')">serif: Literata</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Volkhov')">serif: Volkhov</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Volkhov')">serif: Merriweather</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Imprima')">cool: Imprima</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Livvic')">cool: Livvic</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Muli')">cool: Muli</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Overlock')">cool: Overlock</button>
    <button class="w3-bar-item w3-button w3-small" onclick="setFont('Sansita')">cool: Sansita</button>
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Spectral')">cool: Spectral</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Andika')">Font: Andika</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Cabin')">Font: Cabin</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Hi Melody')">Font: Hi Melody</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Megrim')">Font: Megrim</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Montserrat')">Font: Montserrat</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Noto Sans')">Font: Noto Sans</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Quicksand')">Font: Quicksand</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Raleway')">Font: Raleway</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Roboto')">Font: Roboto</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Volkhov')">Font: Volkhov</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFont('Oswald')">Font: Oswald</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFonts('Oswald','Roboto')">Combo: Oswald/Roboto</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFonts('Volkhov','Noto Sans')">Combo: Volkhov/Noto Sans</button>-->
    <!--<button class="w3-bar-item w3-button w3-small" onclick="setFonts('Andika','Montserrat')">Combo: Andika/Montserrat</button>-->
</div>

<div id="main">

<div class="w3-pale-green">
  <div class="w3-container">
    <button id="openNav" class="w3-button w3-pale-green w3-xlarge" onclick="w3_open()">&#9776;</button>
    <h1 id="appTitle" style="display: inline-block;"><span class="fa fa-book fa-lg"></span> Menalar <?php /* echo $app->getTrans('App Name'); */ ?></h1>
  </div>
</div>

<div style="max-width: 600px; margin: auto auto; min-margin: 5px;">
    <?php echo $app->page->content ?>
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

function setFont(newFont) {
    setFonts(newFont, newFont);
    // document.getElementById("htmlBody").style.fontFamily = newFont;
}

function setFonts(headerFont, bodyFont) {
    document.getElementById("appTitle").style.fontFamily = headerFont;
    document.getElementById("entryTerm").style.fontFamily = headerFont;
    document.getElementById("htmlBody").style.fontFamily = bodyFont;
}

</script>

  <script src="<?php echo $app->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="<?php echo $app->templateUri; ?>js/plugins.js"></script>
  <script src="<?php echo $app->templateUri; ?>js/main.js"></script>

</body>

</html>
