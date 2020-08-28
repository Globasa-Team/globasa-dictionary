<?php
namespace WorldlangDict;

function loadCsv($file)
{
    $parsedown = new \Parsedown();
    $dictionaryCSV = fopen($file, 'r');
    if ($dictionaryCSV === false) {
        die("Failed to open dictionary CSV");
    }
    //What does this do on failure? Empty file? No file found?
    $columnNames = fgetcsv($dictionaryCSV);
    $count = 0;

    while (($word = fgetcsv($dictionaryCSV)) !== false) {
        $count++;
        $newWord = null;
        foreach ($word as $key=>$datum) {
            //$newWord[empty($columnNames[$key])?'Word':$columnNames[$key]] = $parsedown->line($datum);
            $newWord[empty($columnNames[$key])?'Word':$columnNames[$key]] = $datum;
        }
        $wordIndex = strtolower(trim($word[0]));
        $dictionary[$wordIndex] = $newWord;
    }
    return $dictionary;
}
