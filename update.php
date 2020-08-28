<?php namespace WorldlangDict; ?>
<html><head><title>update wordlist</title></head><body><h1>hi</h1></body></html>

<?php



include_once './bootstrap.php';


UpdateController::updateDictionaryData($config);

echo "Done.";

// Build indexes
// echo "<p>Building search indexes...";
// $dictionaryFile->index['eng'] = buildIndex($dictionaryFile->words, 'Eng');
// $dictionaryFile->index['glb'] = buildGlbIndex($dictionaryFile->words);
// echo " Done.</p>";






// Creates search index for Globasa terms.
// Takes a term like '(fe) un mara' and adds it twice:
// 1. Adds full term 'fe un mara'
// 2. Adds shortened term 'un mara'
// If they are the same, such as for 'nini' it just overwrites it.
function buildGlbIndex($words) {
    $resultIndex = [];
    foreach($words as $index=>$data) {
        $word = $data->word;
        $glbWordIndex = strtolower(trim($word));

        // If has optional part, remove and add to index
        if (strpos($word, "(") !== false) {
            // Add to index the full term
            $searchTerm = trim(preg_replace('/[^A-Za-z0-9 \-]/', '', $word));
            $resultIndex[$searchTerm][$glbWordIndex] = $glbWordIndex;
            // Adds shortened term
            $searchTerm = trim(preg_replace('/[\[{\(_].*[\]}\)_]/U' , '', $word));
            $resultIndex[$searchTerm][$glbWordIndex] = $glbWordIndex;
        }

        // Add all terms not in brackets
        $words = explode(' ', preg_replace('/[\[{\(_].*[\]}\)_]/U' , '', $word));
        // TODO

    }

    return $resultIndex;
}

// Build and index in any language.
function buildIndex($words, $lang) {
    $resultIndex = [];
    foreach($words as $index=>$data) {
        switch ($lang) {
            case 'Glb': $trans = $data->word; break;
            case 'Fra': $trans = $data->fra; break;
            case 'Rus': $trans = $data->rus; break;
            case 'Spa': $trans = $data->spa; break;
            case 'Zho': $trans = $data->zho; break;
            default:
            case 'Eng': $trans = $data->eng; break;
        }
        // Remove anything between brackets [{) or _underscore_ markdown.
        $trans = preg_replace('/[\[{\(_].*[\]}\)_]/U' , '', $trans);
        $trans = explode(', ', $trans);
        $trans = extractWords($trans);
        foreach ($trans as $naturalWord) {
            $naturalWord = strtolower(trim($naturalWord));
            if (!empty($naturalWord)) {
                $glbIndex = strtolower(trim($data->word));
                $resultIndex[$naturalWord][$glbIndex] = $glbIndex;
            }
        }
    }

    // Make a string -- deleted because it should be an array in the dict
    // foreach($resultIndex as $key=>$data) {
    //     $resultIndex[$key] = implode(',', $data);
    // }
    ksort($resultIndex);
    return $resultIndex;
}

function extractWords($source) {

    $nestedBracket = 0;
    $nestedUnderscore = 0;
    $result = [];

    foreach($source as $fragment) {
        $subfrags = explode('; ', $fragment);

        if (sizeof($subfrags)>1) {
            $newWords = extractWords($subfrags);
            $result = array_merge($result, $newWords);
        }
        else {
            $result[] = preg_replace("/[^a-zA-Z 0-9]+/", " ", trim($fragment));
        }

    }
    return $result;
}
