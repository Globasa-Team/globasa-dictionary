<?php
namespace WorldlangDict;

class WordView
{
    public static function dictionaryEntry($config, $request, $word, &$page)
    {
        $page->content .='
            <div id="'.$word->term.'" class="dictionaryEntry w3-card" data-search="'.implode(' ', $word->searchText).'" >
            <header class="w3-container w3-blue">
                <h2 id="entryTerm">'.$word->term.'</h2>
            </header>
            <div class="w3-container">
            <p class="definition">'.$word->definition.'</p>
            <p class="etymology">'.sprintf($config->getTrans('Etymology'), $word->etymology).'</p>
            ';
        if (!empty($word->relatedWords)) {
            $page->content .= '
                <p class="alsosee">'.$config->getTrans('Also See List').'</p>'.
                $word->relatedWords;
        }
        $page->content .= '</div>';
        if (isset($request->options['full'])) {
            $page->content .= '<div style="text-align: left; color: black">';
            foreach ($word->wordSource as $key=>$data) {
                $page->content .= '<p><strong style="color: black">'.$key . '</strong>: '. $data. "</p>";
            }
            $page->content .= '</div>';
        }
        $page->content .=
            '<footer class="w3-container w3-pale-blue">
            '.WorldlangDictUtils::makeLink($config, 'leksi/'.$word->term, '<span class="fa fa-link"></span> '.$config->getTrans('Word Link')).'
            &bull; '.$word->ipaLink.'
            </footer>
            </div>
            ';
    }
}
