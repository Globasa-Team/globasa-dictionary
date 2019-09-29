<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $app->page->title; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo $app->templateUri; ?>assets/css/main.css" />
		<link rel="stylesheet" href="<?php echo $app->templateUri; ?>assets/css/globasa.css" />
		<link href="https://fonts.googleapis.com/css?family=Volkhov:400,400i&display=swap" rel="stylesheet"> 
		<noscript><link rel="stylesheet" href="<?php echo $app->templatePath; ?>assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<!--<header>-->
						<!--</header>-->
						<!--<hr />-->
						<?php echo $app->page->content; ?>
						<!--<hr />-->
						<!--<footer>-->
						<!--</footer>-->
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>C0 Globasa</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>