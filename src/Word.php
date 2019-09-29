<?php
namespace GlobasaDictionary;

// A Globasa Word
class Word
{
    private $wordSource;
    private $word;
    private $definition;
    private $etymology;
    private $relatedWords;
    private $langSynonyms;
    
    private $app;
    
    public function get()
    {
        $result ='
            <div id="'.$this->word.'" class="dictionaryEntry" data-search="'.implode(' ', $this->searchText).'">
            <h1>'.$this->word.'</h1>
            <p class="definition">'.$this->definition.'</p>
            <p class="etymology">'.sprintf($this->app->getTrans('Etymology'),$this->etymology).'</p>
            ';
        if (!empty($this->relatedWords)) {
            $result .= '
                <p class="alsosee">'.$this->app->getTrans('Also See List').'</p>'.
                $this->relatedWords;
        }
        $result .=
            '<p class="postWord">
            '.$this->app->makeLink($this->word, '<span class="icon solid fa-link"></span> '.$this->app->getTrans('Word Link')).'
            </p>
            </div>
            ';
        return $result;
    }
    
    public function getReverse()
    {
        $result ='
            <div class="dictionaryEntry" data-search="'.implode(' ', $this->searchText).'">
            <p class="definition">'.$this->word.': '.$this->definition.'</p>
            <p class="etymology">'.sprintf($this->app->getTrans('Etymology'),$this->etymology).'</p>
            ';
        if (!empty($this->relatedWords)) {
            $result .= '
                <p class="alsosee">'.$this->app->getTrans('Also See List').'</p>'.
                $this->relatedWords;
        }
        $result .=
            '<p class="postWord">
            '.$this->app->makeLink($this->word, '<span class="icon solid fa-link"></span> '.$this->app->getTrans('Word Link')).'
            </p>
            </div>
            ';
        return $result;
    }
    
    function __construct($app, $word)
    {
        $this->app = $app;
        $this->wordSource = $word;
        $this->word = $word['Word'];
        $this->definition = $this->processEntryPart($word, 'Definition');
        $this->etymology = $this->processEntryPart($word, 'Etymology');
        $this->relatedWords = $this->makeRelatedWordsUl($this->processEntryList($word['RelatedWordsGlb']));
        $this->searchText = $this->processEntryList($word[$app->langCap]);
        $this->searchText[] = $this->word;
    }
    
    private function makeRelatedWordsUl($listItems) {
        if ($listItems !== null && sizeof($listItems) > 0) {
            
            $result ='<ul>';
            foreach($listItems as $item) {
                $result .= '<li>'.$this->app->makeLink($item) .': '.$this->app->dictionary['glb'][$item]['Definition'.$this->app->langCap].'</li>';
            }
            $result .='</ul>';
        }
        else {
            $result = "";
        }
        return $result;
    }
    
    private function processEntryPart($word, $part)
    {
        if (!empty($word[$part.$this->app->langCap])) {
            return $word[$part.$this->app->langCap];
        } else {
            $result = "";
            if (!empty($word[$part.$this->app->defaultLangCap])) {
                $result = $word[$part.$this->app->defaultLangCap];
            }
            elseif (!empty($word[$part.$this->app->auxLangCap])) {
                $result = $word[$part.$this->app->auxLangCap];
            }
            return $this->app->getTrans('Missing Word Translation').$result;
        }
    }
    
    private function processEntryList($words)
    {
        if(!empty($words) > 0) {
            $words = explode(";", $words);
            foreach ($words as $index=>$word) {
                $words[$index] = trim($word);
            }
            return $words;
        }
        else
        {
            return null;
        }
    }
    
}
