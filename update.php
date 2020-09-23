<?php namespace WorldlangDict;

include_once 'bootstrap.php';

// If not run by client show status
$verbose = (php_sapi_name()!=="cli");
if ($verbose) {
    echo "<html><head><title>".$config->siteName." Update</title></head><body>";
}

UpdateController::updateDictionaryData($config, $verbose);
UpdateController::updateLanguageData($config, $verbose);

if ($verbose) {
    echo "</body></html>";
}
