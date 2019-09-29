<?php

$dictionary = yaml_parse_file('../dictionary.yaml');

function showWordList($dictionary, $lang)
{
    if ($lang == "") {
        $lang='glb';
    }
    foreach ($dictionary[$lang] as $displayWord=>$word) {
        // if ($word['Word']=="Word") {continue;} // Skip CSV header row
        $entry = '<dt>'.$displayWord.'</dt><dd><p class="definition">';
        if ($lang != 'glb') {
            // Look up this word elsewhere
            $word = $dictionary['glb'][$word];
            $entry .= $word['Word'].'</p><p>';
        }
        $entry .= $word['DefinitionEng'];
        $entry .='</p>';
        if ($word['EtymologyEng']) {
            $entry .= '<p class="etymology">Etymology: '.$word['EtymologyEng']."</p>";
        }
        if ($word['RelatedWordsGbl']) {
            $entry .= '<p class="alsosee">Also see '.$word['RelatedWordsGbl'].'.</p>';
        }
        $entry .= '</dd>';
        //dictionary.innerHTML += markdown.makeHtml(entry);
        // print_r($word);
        echo $entry;
    }
}

function showWord($dictionary, $lang, $word)
{
    $word = $dictionary[$lang][$word];
    // if ($word['Word']=="Word") {continue;} // Skip CSV header row
    $entry = '<dt>'.$word['Word'].'</dt><dd><p class="definition">'.$word['DefinitionEng'].'</p>';// should have <p> but markdown doesn't display
    if ($word['EtymologyEng']) {
        $entry .= '<p class="etymology">Etymology: '.$word['EtymologyEng']."</p>";
    }
    if ($word['RelatedWordsGbl']) {
        $entry .= '<p class="alsosee">Also see '.$word['RelatedWordsGbl'].'.</p>';
    }
    $entry .= '</dd>';
    //dictionary.innerHTML += markdown.makeHtml(entry);
    // print_r($word);
    echo $entry;
}
