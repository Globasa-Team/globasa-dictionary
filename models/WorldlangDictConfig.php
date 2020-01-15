<?php
namespace WorldlangDict;

class WorldlangDictConfig
{
    public $siteUri;
    public $siteName;
    public $template;
    public $lang;
    public $langCap;
    public $auxLang;
    public $auxLangCap;
    public $worldlang;
    public $worldlangCap;
    public $templateFolder;
    public $templatePath;
    public $templateUri;
    public $dictionaryFile;
    public $languagesFile;
    public $internationalizationFile;
    public $dictionary;
    public $languages;
    public $trans;
    public $startTime;
    
    public function __construct()
    {
        $this->startTime = microtime(true);
    }
    
    public function setLang($lang, $aux=null)
    {
        $this->lang = strtolower($lang);
        $this->langCap = ucfirst($lang);
        if (!is_null($aux)) {
            $this->auxLang = strtolower($aux);
            $this->auxLangCap = ucfirst($aux);
        }
    }
    
    public function setWorldlang($lang)
    {
        $this->worldlang = strtolower($lang);
        $this->worldlangCap = ucfirst($lang);
    }
    
    public function setTemplate($name, $folder=null)
    {
        $this->template = $name;
        if (!is_null($folder)) {
            $this->templatesFolder = $folder;
        }
        
        $this->templatePath = "./".$this->templatesFolder.'/'.$this->template.'/';
        $this->templateUri = $this->siteUri.$this->templatesFolder.'/'.$this->template.'/';
    }
    
    public function getTrans($textId)
    {
        $missingTranslation = "";
        if (!empty($this->trans[$this->lang][$textId])) {
            return $this->trans[$this->lang][$textId];
        } elseif (!empty($this->trans[$this->defaultLang][$textId])) {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            }
            return $missingTranslation.$this->trans[$this->defaultLang][$textId];
        } elseif (!empty($this->trans[$this->auxLang][$textId])) {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            }
            return $missingTranslation.$this->trans[$this->auxLang][$textId];
        } else {
            if ($textId!='Missing App Text Translation') {
                $missingTranslation = $this->getTrans('Missing App Text Translation');
            } else {
                $missingTranslation = '[hcMissing App Text Translation]';
            }
            return $missingTranslation.$this->trans[$this->auxLang][$textId];
        }
    }
    
    public function getWord($word)
    {
        return $this->dictionary[$this->defaultLang][$word];
    }
    
    
    public function makeLink($request, $text=null, $lang=null)
    {
        if ($lang == null) {
            $lang = $this->lang;
        }
        if ($text == null) {
            $text = $request;
        }
        return '<a href="'.$this->siteUri.$lang.'/'.$request.$this->page->linkQuery.'">'.$text.'</a>';
    }
}
