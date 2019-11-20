<!DOCTYPE HTML>
<!--
	Photon by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $app->page->title; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo $app->templateUri; ?>assets/css/main.css" />
		<link rel="stylesheet" href="<?php echo $app->templateUri; ?>assets/css/globasa.css" />
		<noscript><link rel="stylesheet" href="<?php echo $app->templateUri; ?>assets/css/noscript.css" /></noscript>
		<link href="https://fonts.googleapis.com/css?family=Volkhov:400,400i&display=swap" rel="stylesheet"> 
	</head>
	<body>
        <div id="header"><div id="dictionary">
		<!-- Header -->
			<section id="title">
				<div class="inner">
				    <div id="langBar">
				        <?php echo $app->makeLink($app->request, 'English', 'eng'); ?>
				        <?php echo $app->makeLink($app->request, 'Esperanto', 'epo'); ?>
				        <?php echo $app->makeLink($app->request, 'français', 'fra'); ?>
				        <?php echo $app->makeLink($app->request, 'globasa', 'glb'); ?>
				        <?php echo $app->makeLink($app->request, 'español', 'spa'); ?>
				        <?php echo $app->makeLink($app->request, 'русский', 'rus'); ?>
				        <?php echo $app->makeLink($app->request, '中文', 'zho'); ?>
				    </div>
					<span class="icon solid fa-book"></span> <?php echo $app->getTrans('App Name'); ?><br/>
				</div>
			</section>
			
		<!-- Header -->
			<section id="searchSection">
				<div class="inner">
					<input type="text" id="search" onkeyup="filterDL()" placeholder="<?php echo $app->getTrans('Search Placeholder');?>">
				</div>
			</section>
			
		<!-- Header -->
			<section id="content">
				<div class="inner">
					<?php echo $app->page->content ?>
				</div>
			</section>
        </div></div>


		<!-- Footer -->
			<section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>C0 <a href="http://www.globasa.net/">Globasa</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li>A <a href="http://www.partialsolution.ca/">Partial Solution</a></li>
				</ul>
				<?php echo (microtime(true)-$app->startTime); ?>
			</section>

		<!-- Scripts -->
			<script src="<?php echo $app->templateUri; ?>assets/js/jquery.min.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/jquery.scrolly.min.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/browser.min.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/breakpoints.min.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/util.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/main.js"></script>
			<script src="<?php echo $app->templateUri; ?>assets/js/dictionaryFilter.js"></script>

	</body>
</html>