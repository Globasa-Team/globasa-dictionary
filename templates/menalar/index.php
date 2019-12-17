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
  <link rel="stylesheet" href="<?php echo $app->templateUri; ?>css/globasa.css">
  <link href="https://fonts.googleapis.com/css?family=Andika&display=swap" rel="stylesheet">
  
  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
		<!-- Header -->
		<section id="siteHeader">
			    <div id="langSelect">
			        <?php echo $app->makeLink($app->request, 'English', 'eng'); ?>
			        <?php echo $app->makeLink($app->request, 'Esperanto', 'epo'); ?>
			        <?php echo $app->makeLink($app->request, 'français', 'fra'); ?>
			        <?php echo $app->makeLink($app->request, 'globasa', 'glb'); ?>
			        <?php echo $app->makeLink($app->request, 'español', 'spa'); ?>
			        <?php echo $app->makeLink($app->request, 'русский', 'rus'); ?>
			        <?php echo $app->makeLink($app->request, '中文', 'zho'); ?>
			    </div>
				<h1><span class="icon solid fa-book"></span> <?php echo $app->getTrans('App Name'); ?></h1>
			    <form action="<?php /* echo WorldlangDictUtils::makeUri($app, "search"); */ ?>" method="get">
				    <input type="text" name="term" placeholder="<?php echo $app->getTrans('Search Placeholder');?>" />
			        <input type="submit" name="glbSearch" value="Globasa Search" />
			        <input type="submit" name="langSearch" value="English Search" />
			    </form>
			</div>
		</section>
			
        <section id="siteContent">
            <?php echo $app->page->content ?>
            
        </section>
        
        <section id="siteFooter">
            <ul>
                <li>Globasa</li>
                <li>Github</li>
                <li>Report a problem</li>
                <li>API</li>
            </ul>
            <ul>
                <li>C0 Globasa.net</li>
                <li>A Partial Solution</li>
                <li>Github</li>
            </ul>
        </section>


  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

</body>

</html>
