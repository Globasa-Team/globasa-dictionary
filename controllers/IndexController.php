<?php
namespace WorldlangDict;

class IndexController
{
    public static function home($config) {
        $result = '';
        
        $result .= '<strong>Random word</strong>';
        
        $wordIndex = array_rand($config->dictionary['glb']);
        $word = new Word($config, $config->dictionary['glb'][$wordIndex]);
        $result .= $word->get();
        return $result;
    }
}