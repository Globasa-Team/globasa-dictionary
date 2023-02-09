<?
namespace WorldlangDict;
include_once 'bootstrap.php';
ini_set("output_buffering", "0");
ob_implicit_flush(true);
ob_start();
?>
<html><head>
    <title><?= $config->siteName ?> Update</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    
<main class="w3-main w3-container" style="max-width: 1000px; margin: auto;">

<section class="w3-card w3-container w3-pale-red w3-section"><header>
<h1>Updating local files <?= date('h:i:s') ?></h1>
</header></section>

<?
ob_flush();
flush();
UpdateController::updateDictionaryData($config);
ob_flush();
flush();
UpdateController::updateLanguageData($config);
?>

<section class="w3-card w3-container w3-pale-green w3-section"><header>
    <h2>👍 Updating complete.</h2>
</header></section>

</main>

</body></html>
<?
ob_end_flush();