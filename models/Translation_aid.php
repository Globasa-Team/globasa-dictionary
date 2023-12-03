<?php
namespace WorldlangDict;

class Translation_aid
{



    public static function transAideBulkTranslate($config, $request) {
        $text = isset($_REQUEST['text']) ? $_REQUEST['text'] : null;
        $result = [];
        
        // Old code that broke text apart by line return
        // if (!empty($words)) {
            //     $words = preg_split("@[\s+　]@u", trim($text));
        // }
        
        // Break text up by sentence.
        
        // “” ‘’
        // '/(?<=[.?!"\'])\s+(?=[a-z])/i'
        // /(?<=[.?!"\'])\s+(?=[a-zA-Z0-9])/
        if (!empty($text)) {
            //$sentences = preg_split('/(?<=[.?!"\'])\s+(?=[a-zA-Z0-9"\'])/i', $text);
            $sentences = preg_split('/(?<=[.?!"\'”’‽])\s+(?=[a-zA-Z0-9"\'“‘])/i', $text);
            
            foreach($sentences as $key=>$sentence) {
                $sentenceResult = new \stdClass();
                $sentenceResult->sentence = $sentence;
                $sentence = strtolower($sentence);

                // Remove punctuation using PCRE unicode character class for all punctuation characters
                $sentence = preg_replace('/\p{P}/', '', $sentence);
                $sentence = preg_replace('/[“”‘’]/', '', $sentence);
                
                // Split on whitepace
                $sentenceResult->words = preg_split("@[\s+　]@u", trim($sentence));
    
                $result[] = $sentenceResult;
            }

        }

        return $result;
        
    }


}
