<?php
namespace WorldlangDict;

class Page {
    
    public $title;
    public $content;
    public $siteName;
    
    public function __construct($siteName) {
        $this->title = $this->siteName = $siteName;
        $content = "";
    }
    
    public function setTitle($title)
    {
        $this->title = $title . ' - ' . $this->siteName;
    }
    
}