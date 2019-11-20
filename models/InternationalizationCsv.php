<?php
namespace GlobasaDictionary;

class InternationalizationCsv {
    
    public function __construct($app) {
        
        $langResourceCSV = fopen("https://docs.google.com/spreadsheets/d/e/2PACX-1vSO5XoKxLLV0rE5_esaYqtj10LwbBuaVTvpLRbp3OnTa7fTvD1NFeEcS11Hwa9tMymUUuuGO3_R4Op7/pub?output=csv", 'r');
        
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
        
        if(!empty($langResource)) {
            yaml_emit_file("/home/jsnowban/public_html/demo/globasa-dictionary/data/internationalization.yaml", $langResource);
        }
    }
    
}



