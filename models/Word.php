<?php
namespace WorldlangDict;

// A Globasa Word
class Word
{
    public $wordSource;
    public $term;
    public $definition;
    public $etymology;
    public $relatedWords;
    public $langSynonyms;
    public $ipaLink;
    
    private $app;
    
    public function getDelete($match = null)
    {
        $result ='
            <div id="'.$this->term.'" class="dictionaryEntry w3-card" data-search="'.implode(' ', $this->searchText).'" '.$displayAttribute.'>
            <header class="w3-container w3-green">
                <h2 id="entryTerm">'.$this->term.'</h2>
            </header>
            <div class="w3-container">
            <p class="definition">'.$this->definition.'</p>
            <p class="etymology">'.sprintf($this->app->getTrans('Etymology'), $this->etymology).'</p>
            ';
        if (!empty($this->relatedWords)) {
            $result .= '
                <p class="alsosee">'.$this->app->getTrans('Also See List').'</p>'.
                $this->relatedWords;
        }
        $result .= '</div>';
        if (isset($this->app->page->options['full'])) {
            $result .= '<div style="text-align: left; color: black">';
            foreach ($this->wordSource as $key=>$data) {
                $result .= '<p><strong style="color: black">'.$key . '</strong>: '. $data. "</p>";
            }
            $result .= '</div>';
        }
            // '.$this->app->makeLink('leksi/'.$this->word, '<span class="icon solid fa-link"></span> '.$this->app->getTrans('Word Link')).'
        $result .=
            '<footer class="w3-container w3-pale-green">
            '.$this->app->makeLink('leksi/'.$this->word, '<span class="fa fa-link"></span> '.$this->app->getTrans('Word Link')).'
            </footer>
            </div>
            ';
        return $result;
    }
    
    public function getReverse()
    {
        $result ='
            <div class="dictionaryEntry" class="w3-card" data-search="'.implode(' ', $this->searchText).'">
            <header class="w3-container w3-blue">
            <div class="w3-container">
            <p class="definition">'.$this->word.': '.$this->definition.'</p>
            </div>
            <p class="etymology">'.sprintf($this->app->getTrans('Etymology'), $this->etymology).'</p>
            ';
        if (!empty($this->relatedWords)) {
            $result .= '
                <p class="alsosee">'.$this->app->getTrans('Also See List').'</p>'.
                $this->relatedWords;
        }
        $result .=
            '</div>
            <footer class="w3-container pale-green">
            <p class="postWord">
            '.$this->app->makeLink('cel-ruke/'.$this->word, '<span class="icon solid fa-link"></span> '.$this->app->getTrans('Word Link')).'
            </p>
            </footer>
            </div>
            ';
        return $result;
    }
    
    public function __construct($app, $data)
    {
        $this->app = $app;
        $this->wordSource = $data;
        $this->term = $data['Word'];
        $this->definition = $this->processEntryPart($data, 'Translation');
        $this->etymology = $this->processEntryPart($data, 'Etymology');
        $this->relatedWords = $this->makeRelatedWordsUl($this->processEntryList($data['RelatedWordsGlb']));
        $this->searchText = $this->processEntryList($data[$app->langCap]);
        $this->searchText[] = $this->word;
        $this->ipa();
    }
    
    private function makeRelatedWordsUl($listItems)
    {
        if ($listItems !== null && sizeof($listItems) > 0) {
            $result ='<ul>';
            foreach ($listItems as $item) {
                if (isset($this->app->dictionary['glb'])&&isset($this->app->dictionary['glb'][$item])) {
                    $result .= '<li>'.$this->app->makeLink('leksi/'.$item, $item) .': '.$this->app->dictionary['glb'][$item]['Translation'.$this->app->langCap].'</li>';
                } else {
                    $result .= '<li>'.$this->app->makeLink('leksi/'.$item, $item) .': *ERROR*</li>';
                }
            }
            $result .='</ul>';
        } else {
            $result = "";
        }
        return $result;
    }
    
    private function processEntryPart($data, $part)
    {
        if (!empty($data[$part.$this->app->langCap])) {
            return $data[$part.$this->app->langCap];
        } else {
            $result = "";
            if (!empty($data[$part.$this->app->defaultLangCap])) {
                $result = $data[$part.$this->app->defaultLangCap];
            } elseif (!empty($data[$part.$this->app->auxLangCap])) {
                $result = $data[$part.$this->app->auxLangCap];
            }
            return $this->app->getTrans('Missing Word Translation').$result;
        }
    }
    
    private function processEntryList($words)
    {
        if (!empty($words) > 0) {
            $words = explode(";", $words);
            foreach ($words as $index=>$word) {
                $words[$index] = trim($word);
            }
            return $words;
        } else {
            return null;
        }
    }
    
    private function ipa() {
        $phrase = strtolower($this->term);
        $pattern = ['/c/', '/h/', '/j/', '/r/', '/x/', '/y/'];
        $replacement = ['tʃ', 'x', 'dʒ', 'ɾ', 'ʃ', 'j'];
        $result = preg_replace($pattern, $replacement, $phrase);
        $result = "http://ipa-reader.xyz/?text=".$result."&voice=Carla";
        $result = '<a href="'.$result.'"><span class="fa fa-volume-up"></span> listen</a>';
        $this->ipaLink = $result;
    }
}
