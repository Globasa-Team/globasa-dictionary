<?php
namespace WorldlangDict;

class UpdateController
{
    public static function updateDictionaryData($config)
    {
        echo '<section class="w3-card w3-section">';
        echo '<header class="w3-container w3-pale-yellow "><h2>📖 Updating dictionary data...</h2></header>';

        echo "<p class=\"w3-container\">Backing up current CSV file.</p>\n";
        copy($config->csvLocation, $config->csvLocation.'.bak');
        if(!isset($config->debugging)||!$config->debugging) {
            echo "<p class=\"w3-container\"> ... download word list.</p>\n";
            downloadFile($config->remoteCsvLocation, $config->csvLocation);
        } else {
            echo "<p class=\"w3-container\"> ... skipping word list download.</p>\n";
        }
        $rawWords = loadCsv($config->csvLocation);
        
        echo "<p class=\"w3-container\"> ... Processing words: \n";
        $dictionary = Word::createDictionary($config, $rawWords);
        Word::saveDictionary($config, $dictionary);
        echo '</section>
        ';
    }

    public static function updateLanguageData($config)
    {

        echo '<section class="w3-card w3-section">';
        echo '<header class="w3-container w3-pale-blue"><h2>🌐 Downloading i18n language data...</h2></header>';
        $langResourceCSV = fopen($config->remoteI18nCsvLocation, 'r');
        if ($langResourceCSV === false) {
            die("Failed to open lang CSV");
        }
        //What does this do on failure? Empty file? No file found?

        $columnNames = fgetcsv($langResourceCSV);
        echo "<p class=\"w3-container\"> ... found columns for ".implode(", ", $columnNames)."</p>\n";
        echo "<p class=\"w3-container\">";
        while (($textData = fgetcsv($langResourceCSV)) !== false) {
            foreach ($textData as $key=>$datum) {
                if ($key == 0) {
                    $textId = $datum;
                    if (empty($textData[2])) echo "<span class=\"w3-tag w3-orange w3-round\">{$datum}</span> ";
                    continue;
                }
                $langResource[$columnNames[$key]][$textId] = $datum;
            }
        }
        echo "</p>";
        yaml_emit_file($config->i18nFile, $langResource);
        echo '<footer class="w3-container w3-pale-blue"><p> ... i18n language data saved.</p></footer>';
        echo '</section>';
    }
}
