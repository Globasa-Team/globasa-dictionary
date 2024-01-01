<?php
namespace WorldlangDict;

class Tags_controller {
    public static function addTags($config, $request, &$page)
    {
        $tags = yaml_parse_file($config->tag_location);
        $defs = yaml_parse_file($config->min_location . "{$config->lang}.yaml");
    
        if (isset($request->arguments[0]) && isset($tags[$request->arguments[0]])) {
            $tag = $request->arguments[0];
            $page->setTitle($tag . ' &mdash; ' . $config->getTrans('single tag view'));
            include_once('views/tags_display_view.php');
        } else {
            $page->setTitle($config->getTrans('tags title'));
            include_once('views/tags_default_view.php');
        }
    }
}