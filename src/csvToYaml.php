<?php
include_once("Parsedown.php");
$parsedown = new \Parsedown();

//$app->parsedown->line();

// $dictionaryCSV = fopen("../dictionary.csv", 'r');
$dictionaryCSV = fopen("https://docs.google.com/spreadsheets/d/e/2PACX-1vTmEl02B05rJb-4UprfWskosFg_kMCCji8nSn10vesbWNnUx9QaonF0-AnM0IEBGXeAMryYI_IOW0sz/pub?gid=0&single=true&output=csv", 'r');
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
        $newWord[empty($columnNames[$key])?'Word':$columnNames[$key]] = $parsedown->line($datum);
        
        if ($columnNames[$key] == 'Eng' || $columnNames[$key] == 'Fra' || $columnNames[$key] == 'Spa' || $columnNames[$key] == 'Rus' || $columnNames[$key] == 'Zho') {
            $naturalWords = explode(',', $datum);
            foreach ($naturalWords as $naturalWord) {
                if (!empty($naturalWord)) {
                    if (isset($naturalWordList[$columnNames[$key]][trim($naturalWord)])) {
                        $naturalWordList[$columnNames[$key]][trim($naturalWord)] .= ", ".trim($word[0]);
                    } else {
                        $naturalWordList[$columnNames[$key]][trim($naturalWord)] = trim($word[0]);
                    }
                }
            }
        }
    }
    
    $dictionary[$word[0]] = $newWord;
}
fclose($dictionaryCSV);
ksort($naturalWordList['Eng']);
ksort($naturalWordList['Fra']);
ksort($naturalWordList['Spa']);
ksort($naturalWordList['Rus']);
ksort($naturalWordList['Zho']);

$wordLists['glb'] = $dictionary;
$wordLists['eng'] = $naturalWordList['Eng'];
$wordLists['fra'] = $naturalWordList['Fra'];
$wordLists['spa'] = $naturalWordList['Spa'];
$wordLists['rus'] = $naturalWordList['Rus'];
$wordLists['zho'] = $naturalWordList['Zho'];

// echo "<p>Trying to create YAML file.</p>\n\n<pre>";
yaml_emit_file("/home/jsnowban/public_html/demo/globasa-dictionary/data/dictionary.yaml", $wordLists);
// echo "</pre>\n\n<p>Done, I hope.</p>";

$fp = fopen('/home/jsnowban/public_html/demo/globasa-dictionary/data/dictionary.json', 'w');
fwrite($fp, json_encode($wordLists));
fclose($fp);

$fp = fopen('/home/jsnowban/public_html/demo/globasa-dictionary/data/dictionary.js', 'w');
fwrite($fp, "var dictionary = ".json_encode($wordLists));
fclose($fp);









$langResourceCSV = fopen("https://docs.google.com/spreadsheets/d/e/2PACX-1vSO5XoKxLLV0rE5_esaYqtj10LwbBuaVTvpLRbp3OnTa7fTvD1NFeEcS11Hwa9tMymUUuuGO3_R4Op7/pub?output=csv", 'r');
if ($langResourceCSV === false) {
    die("Failed to open lang CSV");
}
//What does this do on failure? Empty file? No file found?

$columnNames = fgetcsv($langResourceCSV);

while (($textData = fgetcsv($langResourceCSV)) !== false) {
    // $newWord = null;
    foreach ($textData as $key=>$datum) {
        if ($key == 0) {
            $textId = $datum;
            continue;
        }
        $langResource[$columnNames[$key]][$textId] = $datum;
        // $newWord[] = $parsedown->line($datum);
    }
}

yaml_emit_file("/home/jsnowban/public_html/demo/globasa-dictionary/data/internationalization.yaml", $langResource);
