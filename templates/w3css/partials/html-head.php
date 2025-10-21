<?php
namespace WorldlangDict;

$dtime = date("zGi", filemtime($config->templatePath.'css/default.css'));
$ctime = date("zGi", filemtime($config->templatePath.'css/'.$config->custom_id.'.css'));


?>
<head>
  <meta charset="utf-8">
  <title><?php echo $page->title ?? "500: Globasa"; ?></title>
  <meta name="description" content="<?php echo $page->description ?? ""; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?=$config->site_logo_url;?>">
  <link rel="icon" type="image/png" href="<?=$config->site_logo_url;?>">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/default.css?<?= $dtime; ?>">
<? if ($config->custom_id != "default") : ?>
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/<?= $config->custom_id ?>.css?<?= $ctime; ?>">
<? endif; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script src="<?php echo $config->siteUri; ?>assets/ipa.js?02-08"></script>
  <script src="<?php echo $config->siteUri; ?>assets/browse.js?2023-12-18"></script>

</head>