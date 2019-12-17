<?php
namespace WorldlangDict;

class WordController {
    
    public static function randomWord($config) {
        $result = '<strong>Random word</strong>';
        $wordIndex = array_rand($config->dictionary['glb']);
        $word = new Word($config, $config->dictionary['glb'][$wordIndex]);
        $result .= $word->get();
        return $result;
    }
}