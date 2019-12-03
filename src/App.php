<?php
namespace WorldlangDict;

class WorldlangDictConfig {
    public $siteUri, $siteName, $template, $lang, $langCap, $defaultLang, $defaultLangCap, $auxLang, $auxLangCap, $templateFolder, $templatePath, $templateUri, $dictionaryFile, $languagesFile, $internationalizationFile, $dictionary, $languages, $trans, $startTime;
    
    function __construct() {
        $this->startTime = microtime(true);
    }
    
    public function setLang($lang, $aux=null) {
        $this->lang = strtolower($lang);
        $this->langCap = ucfirst($lang);
        if (!is_null($aux)) {
            $this->defaultLang = strtolower($aux);
            $this->defaultLangCap = ucfirst($aux);
        }
    }
    
    public function setTemplate($name, $folder=null) {
        $this->template = $name;
        if (!is_null($folder)) {
            $this->templatesFolder = $folder;
        }
        
        $this->templatePath = "./".$this->templatesFolder.'/'.$this->template.'/';
        $this->templateUri = $this->siteUri.$this->templatesFolder.'/'.$this->template.'/';
    }
    public function setPageTitle($title) {
        $this->page->title = $title . ' - ' . $this->siteName;
    }
    
    public function getTrans($textId) {
        $missingTranslation = "";
        if (!empty($this->trans[$this->lang][$textId])) {
            return $this->trans[$this->lang][$textId];
        }
        elseif (!empty($this->trans[$this->defaultLang][$textId])) {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            }
            return $missingTranslation.$this->trans[$this->defaultLang][$textId];
        }
        elseif (!empty($this->trans[$this->auxLang][$textId])) {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            }
            return $missingTranslation.$this->trans[$this->auxLang][$textId];
        }
        else {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            } else {
                $missingTranslation = '[hcMissing App Text Translation]';
            }
            return $missingTranslation.$this->trans[$this->auxLang][$textId];
        }
    }
    
    public function getWord($word) {
        return $this->dictionary[$this->defaultLang][$word];
    }
    
    public function INeedThisForSomeReason () {
    // does not work this is returing an array and prepending a string. Algorithm is good.
        if (isset($this->dictionary[$this->lang][$word])) {
            return $this->dictionary[$this->lang][$word];
        } else {
            if (isset($this->dictionary[$this->defaultLang][$word])) {
                return $this->getTrans('Missing Translation').$this->dictionary[$this->defaultLang][$word];
            }
            else {
                return $this->getTrans('Missing Translation').$this->dictionary[$this->auxLang][$word];
            }
        }
    }
    
    public function makeLink($request, $text=null, $lang=null) {
        if ($lang == null) {
            $lang = $this->lang;
        }
        if ($text == null) {
            $text = $request;
        }
        return '<a href="'.$this->siteUri.$lang.'/'.$request.$this->page->linkQuery.'">'.$text.'</a>';
    }
}