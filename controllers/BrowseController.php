<?php
namespace WorldlangDict;

class BrowseController
{
    public static function default($config, $request, &$page)
    {
        $page->setTitle("Globasa translation dictionary");
        BrowseController::results($config, $request->lang, $request, $page);
    }


    public static function results($config, $lang, $request, $page)
    {
        // Show matches
        foreach($config->dictionary->index[$lang] as $entry) {
            foreach($entry as $word) {

                $listing[$word] = BrowseController::entryToString($config, $request, $word);
            }
        }
        ksort($listing);

        $page->content .= '<dl class="dictionaryList">'.implode($listing)."</dl>";
    }

    private static function entryToString($config, $request, $word) {
        $result = '<dt>'.
            WorldlangDictUtils::makeLink(
                $config,
                'lexi/'.urlencode($word),
                $request,
                $config->dictionary->words[$word]->term
            );
        if (isset($config->dictionary->words[$word]->wordClass) && !empty($config->dictionary->words[$word]->wordClass)) {
            $result .=
                '<div class="wordClass">(<a href="https://xwexi.globasa.net/' . $config->lang . '/grammar/word-classes">'.$config->dictionary->words[$word]->wordClass.'</a>)</div>';
        }
        $result .=
            '</dt><dd>'.
            $config->dictionary->words[$word]->translation[$config->lang].
            '</dd>';

        return $result;
    }
}
