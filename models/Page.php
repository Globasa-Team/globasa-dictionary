<?php
namespace WorldlangDict;

class Page
{
    public $title;
    public $content;
    public $siteName;
    public $description;

    public function __construct($siteName)
    {
        $this->title = $this->siteName = $siteName;
        $this->content = '';
        $this->description = '';
    }

    public function setTitle($title)
    {
        $this->title = $title . ' &mdash; ' . $this->siteName;
    }
}
