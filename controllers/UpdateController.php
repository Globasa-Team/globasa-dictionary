<?php
namespace WorldlangDict;

class UpdateController {

    public static function updateDictionaryData($config) {
        downloadFile($config->remoteCsvLocation, $config->csvLocation);
        $rawWords = loadCsv($config->csvLocation);
        $dictionary = Word::createDictionary($config, $rawWords);
        Word::saveDictionary($config, $dictionary);
    }
}
