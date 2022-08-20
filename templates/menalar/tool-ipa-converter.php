<?php
namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $page->title; ?></title>
  <meta name="description" content="<?php echo $page->description; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="<?php echo $config->siteUri; ?>globasa-logo.webp">
  <link rel="icon" type="image/png" href="<?php echo $config->siteUri; ?>globasa-logo.webp">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/globasa.css?3-04">
  <link href="https://fonts.googleapis.com/css?family=Literata|Merriweather&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <meta name="theme-color" content="#fafafa">
</head>

<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->




<div id="siteHeader">
    <h1 id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>">
            <span class="fa fa-book fa-lg"></span> <?php echo $config->siteName; ?>
        </a>
    </h1>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>"><?php echo $config->getTrans('random word button');?></a> &bull;
        <a href="https://xwexi.globasa.net/<?php echo $config->lang;?>/gramati/lexiklase"><?php echo $config->getTrans('word classes link');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/translation-aide', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a>
    <form action="<?php echo WorldlangDictUtils::makeUri($config, "search", $request); ?>" method="get">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell">
            <input type="text" name="wTerm" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['wterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell">
            <input type="text" name="nTerm" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['nterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell w3-cell-middle">
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" class="w3-btn" />
        </div>
    </div>
    </form>


</div>



<div id="content" class="w3-main">
  <div class="w3-container" style="padding: 5px">
    <h1><?php echo $config->getTrans('ipa converter title');?></h1>
    <p><?php echo $config->getTrans('ipa converter instructions');?></p>
    <textarea name="globasaInput" id="globasaInput" class="w3-input w3-border w3-light-grey" placeholder="<?php echo $config->getTrans('ipa converter input placeholder');?>"></textarea>

    <button onClick="convertToIpa()" class="w3-btn w3-blue-grey"><?php echo $config->getTrans('ipa converter button');?></button>
    
    <p><?php echo $config->getTrans('ipa converter output label');?><p>
    <blockquote name="ipaOutput" id="ipaOutput" class="w3-pale-blue" style="white-space: pre-wrap; padding: 5px;"><em><?php echo $config->getTrans('ipa converter ipa placeholder');?></em></blockquote>
    
  </div>
</div>




<script>


// Exceptions to the stress rules: one syllable words that have no stresses
const WORDS_TO_SKIP = new Set(["ji", "or", "nor", "kam", "mas", "kwas", "ki", "hu", "su", "el", "na", "le", "xa", "kom", "di", "ci", "fe", "in", "ex", "per", "bax", "of", "cel", "hoy", "pas", "tras", "cis", "wey", "fol", "de", "tas", "tem", "pro", "fal", "har", "ton", "yon", "por", "dur"]);

// Globasa latin script to IPA replacement mapping
const IPA_REPLACEMENTS = [
  {letter:'c', replacement:'t͡ʃ'},
  {letter:'j', replacement:'d͡ʒ'},
  {letter:'r', replacement:'ɾ'},
  {letter:'x', replacement:'ʃ'},
  {letter:'y', replacement:'j'},
  {letter:'h', replacement:'x'}
]

const STRESS_MARKER = 'ˈ';

const FINAL_VOWEL_REGEX = /[aeiou](?!.*[aeiou])/i
const MATCH_WORDS_REGEX = /\b\w*[-']*\w*\b/g

// Word matching regex alterantives from https://stackoverflow.com/questions/31910955/regex-to-match-words-with-hyphens-and-or-apostrophes

const VOWELS = ['a', 'e', 'i', 'o', 'u'];
const DOUBLE_SHIFT_LETTERS = ['y', 'w', 'r', 'l' ];


/*
  Converts text in globasaInput (Globasa latin script) to IPA for
  text to speech applications. Also creates link to reader.
*/
function convertToIpa() {
  let text = document.getElementById("globasaInput").value.toLowerCase();
  text = replaceLettersWithIPA(addStressesToText(text));
  document.getElementById("ipaOutput").innerHTML = text;
  // document.getElementById("ipaLink").href="https://ipa-reader.xyz/?text="+text+"&voice=Ewa";
}



/*
  Simple replacement of letters to IPA
*/
function replaceLettersWithIPA(text) {
  for(let rule of IPA_REPLACEMENTS) {
    text = text.replaceAll(rule.letter,rule.replacement);
  }
  
  return text;
}



/*
  Takes text that may have paragraph new lines and sentence punctuation,
  and calls stressVowels() for each word.
*/
function addStressesToText(input) {

  let output = "";
  let previousEnd = 0;
  
  const words = input.matchAll(MATCH_WORDS_REGEX);

  for (const word of words) {
    
    // Non-words are empty strings
    if (word[0].length == 0) {
      continue;
    }
    
    // Get any skipped characters, which would be between words
    output += input.slice(previousEnd, word.index);
    // Add stress markers to current work
    output += addStressToWord(word[0], true);
    previousEnd = word.index + word[0].length
  }
  
  output += input.slice(previousEnd);
  
  return output;
}



/*
  Adds stress markers according to Globasa grammer:
  
  If it's on the one-syllable excluded list, do not stress any vowels.
  If the word ends with a vowel, stress the second last vowel.
  If it does not end with a vowel, stress the last vowel.
  
  If the letter before the selected vowel is a consonant, move the stress
  left to the consonant, unless it is y, w, r and l. In that case move it
  two to the left. If that would go beyond the first letter of the word,
  leave it on the first letter.
  
  Algorithm:
  
  If the word is on the one syllable excluded list, do nothing. Otherwise,
  take the word and remove the last letter. Of the remainder, add a stress
  marker before the last vowel in the word.
  
  The stress will shift 0, 1 or 2 slots to the left:
  - If previous character is a vowel or is pos 0, the stress mark doesn't move. 
  - If previous character is y, w, r or l and pos > 1, shift left by 2
  - else, shift left by 1 (if any other consonant or double shift would be out of bounds.)

*/
function addStressToWord(word, debug = false) {

  if (WORDS_TO_SKIP.has(word)) {
    return word;
  }
  
  const match = word.slice(0, -1).match(FINAL_VOWEL_REGEX);
  const pos = word.slice(0, -1).lastIndexOf(match);
  
  let shift = 0;
  if ( pos > 0 && !VOWELS.includes(word.charAt(pos-1)) ) {
    if( pos > 1 && DOUBLE_SHIFT_LETTERS.includes(word.charAt(pos-1)) ) {
      shift = -2;
    }
    else {
      shift = -1;
    }
  }
  
  return word.slice(0, pos+shift) + STRESS_MARKER + word.slice(pos+shift);  
}
</script>





<footer id="siteFooter" class="w3-container w3-padding-large w3-light-grey w3-opacity">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p>C0 <a href="https://www.globasa.net">Globasa.net</a>.<br/>
            A <a href="https://www.partialsolution.ca/">Partial Solution</a>.</p>
        </div>
        <div class="w3-container w3-cell w3-mobile" style="text-align: center;">
        <?php
        $firstLang = true;
        foreach($config->userLangs as $curLang=>$curName) {
            $uri = WorldlangDictUtils::changeLangUri($config, $request, $curLang);
            if (!$firstLang) echo " &bull; ";
            else $firstLang = false;
            echo "<a href=\"{$uri}\">{$curName}</a>";
        } ?>
        </div>

        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p><a href="https://www.globasa.net/" class="w3-button"><span class="fa fa-link"></span> <?php echo $config->getTrans('globasa link');?></a><br/>
            <a href="https://github.com/ShawnPConroy/WorldlangDict" class="w3-button"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a><br/>
            <a href="<?php echo WorldlangDictUtils::makeUri(
    $config,
    'am-reporte/?url='.$config->siteUri.substr($request->url, 1),
    $request
); ?>" class="w3-button"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a><br/>
            <a href="https://api.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a></p>
        </div>
    </div>
</footer>

  <script src="<?php echo $config->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="<?php echo $config->templateUri; ?>js/plugins.js"></script>
  <script src="<?php echo $config->templateUri; ?>js/main.js"></script>

</body>

</html>
