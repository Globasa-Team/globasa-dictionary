<?php
namespace WorldlangDict;

class IndexView {
    
    public static function home ($randomDefinition) {
        $result = '<h1>Random Word</h1>'.
            $randomDefinition;
        return $result;
    }
}