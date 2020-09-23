<?php
namespace WorldlangDict;

class UpdateController
{
    public static function updateDictionaryData($config, $verbose)
    {
        if ($verbose) echo "<h2>📖 Updating dictionary data...</h2>";
        if ($verbose) echo "<p> ... download word list.</p>";
        downloadFile($config->remoteCsvLocation, $config->csvLocation);
        $rawWords = loadCsv($config->csvLocation);
        if ($verbose) echo "<p> ... Processing words</p>";
        $dictionary = Word::createDictionary($config, $rawWords, $verbose);
        Word::saveDictionary($config, $dictionary);
    }

    public static function updateLanguageData($config, $verbose)
    {
        if ($verbose) echo "<h2>🌐 Downloading i18n language data...</h2>";
        $langResourceCSV = fopen($config->remoteI18nCsvLocation, 'r');
        if ($langResourceCSV === false) {
            die("Failed to open lang CSV");
        }
        //What does this do on failure? Empty file? No file found?

        $columnNames = fgetcsv($langResourceCSV);
        if ($verbose) echo "<p> ... found columns for ".implode(", ", $columnNames)."</p>";

        while (($textData = fgetcsv($langResourceCSV)) !== false) {
            foreach ($textData as $key=>$datum) {
                if ($key == 0) {
                    $textId = $datum;
                    if ($verbose) echo $datum.' ';
                    continue;
                }
                $langResource[$columnNames[$key]][$textId] = $datum;
            }
        }
        yaml_emit_file($config->i18nFile, $langResource);
        if ($verbose) echo "<p> ... i18n language data saved.</p>";
    }
}
