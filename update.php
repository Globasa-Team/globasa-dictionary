<?php namespace WorldlangDict;

include_once 'bootstrap.php';

// If not run by client show status
$verbose = (php_sapi_name()!=="cli");
if ($verbose) {
    echo "<html><head><title>".$config->siteName." Update</title></head><body>
    <h1>Updating local files</h1>";
}

UpdateController::updateDictionaryData($config, $verbose);
UpdateController::updateLanguageData($config, $verbose);

if ($verbose) {
    echo "<h2>👍 Updating complete.</h2></body></html>";
}
