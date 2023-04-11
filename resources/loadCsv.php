<?php
namespace WorldlangDict;

function loadCsv($file)
{
    $dictionaryCSV = fopen($file, 'r');
    if ($dictionaryCSV === false) {
        die("Failed to open dictionary CSV");
    }
    //What does this do on failure? Empty file? No file found?
    $columnNames = fgetcsv($dictionaryCSV);

    while (($word = fgetcsv($dictionaryCSV)) !== false) {
        $newWord = null;
        foreach ($word as $key=>$datum) {
            $newWord[empty($columnNames[$key])?'Word':$columnNames[$key]] = $datum;
        }
        $wordIndex = strtolower(trim($word[0]));
        $dictionary[$wordIndex] = $newWord;

        if (strcmp($wordIndex, "falso") == 0) {
            var_dump($word);
            var_dump($newWord);
            die();
        }
    }
    return $dictionary;
}
