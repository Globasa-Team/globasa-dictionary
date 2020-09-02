<?php
namespace WorldlangDict;

class UpdateController
{
    public static function updateDictionaryData($config)
    {
        //downloadFile($config->remoteCsvLocation, $config->csvLocation);
        $rawWords = loadCsv($config->csvLocation);
        $dictionary = Word::createDictionary($config, $rawWords);
        Word::saveDictionary($config, $dictionary);
    }

    public static function updateLanguageData($config)
    {
        $langResourceCSV = fopen($config->remoteI18nCsvLocation, 'r');
        if ($langResourceCSV === false) {
            die("Failed to open lang CSV");
        }
        //What does this do on failure? Empty file? No file found?

        $columnNames = fgetcsv($langResourceCSV);

        while (($textData = fgetcsv($langResourceCSV)) !== false) {
            foreach ($textData as $key=>$datum) {
                if ($key == 0) {
                    $textId = $datum;
                    continue;
                }
                $langResource[$columnNames[$key]][$textId] = $datum;
            }
        }
        yaml_emit_file($config->i18nFile, $langResource);
    }
}
