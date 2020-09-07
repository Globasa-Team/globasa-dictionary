<?php
namespace WorldlangDict;

class WordView
{
    public static function dictionaryEntry($config, $request, $word, &$page)
    {
        $page->description = $word->term . ': ' . htmlspecialchars($word->translation[$config->lang]);
        $page->content .='
            <div id="'.$word->term.'" class="dictionaryEntry w3-card" data-search="'./*implode(' ', $word->searchText).*/'" >
            <header class="w3-container">
                <h2 id="entryTerm">'.$word->term.'</h2>
            </header>
            <div class="w3-container">
            <p class="definition">'.$word->translation[$config->lang].'</p>';
        if (!empty($word->example)) {
            $page->content .='
                <p class="example">'.sprintf($config->getTrans('Example'), $word->example).'</p>';
        }
        if (!empty($word->etymology)) {
            $page->content .='
                <p class="etymology">'.sprintf($config->getTrans('Etymology'), $word->etymology).'</p>';
        }
        if (!empty($word->relatedWords)) {
            foreach ($word->relatedWords as $i=>$cur) {
                $word->relatedWords[$i] = WorldlangDictUtils::makeLink(
                    $config,
                    'leksi/'.$cur,
                    $cur
                );
            }
            $page->content .= '
                <p class="alsosee">'.
                sprintf(
                    $config->getTrans(
                        'Also See Sentence'
                    ),
                    implode(', ', $word->relatedWords)
                ).'</p>';
        }
        if (!empty($word->tags)) {
            foreach($word->tags as $i=>$tag) {
                $word->tags[$i] = WorldlangDictUtils::makeLink(
                    $config,
                    "leksilar/".$tag,
                    $tag
                );
            }
            $page->content .= '
                <p class="tags">'.sprintf(
                    $config->getTrans('tags links'),
                    implode($word->tags)
                    ).'</p>
                    ';
        }
        else die("fail");

        $page->content .= '</div>';
        if (isset($request->options['full'])) {
            $page->content .= '<div style="text-align: left; color: black">';
            foreach ($word->wordSource as $key=>$data) {
                $page->content .= '<p><strong style="color: black">'.$key . '</strong>: '. $data. "</p>";
            }
            $page->content .= '</div>';
        }
        $page->content .=
            '<footer class="w3-container">
            '.WorldlangDictUtils::makeLink(
                $config,
                'leksi/'.$word->term,
                '<span class="fa fa-link"></span> '.
                    $config->getTrans('Word Link')
            ).'
            &bull; '.$word->ipaLink.'
            </footer>
            </div>
            ';
    }

    public function addList($config, $request, &$page)
    {
        foreach ($config->dictionary->words as $wordIndex=>$entry) {
            if (is_a($entry, 'WorldlangDict\Word')) {
                if ($list->listLang != "glb") {
                    $page->content .= '<h1>'.
                        sprintf(
                            $config->getTrans('Entry for'),
                            $wordIndex,
                            $list->lang
                        ).'</h1>';
                }
                WordView::DictionaryEntry($config, $request, $entry, $page);
            } else {
                if ($list->listLang != $config->worldlang) {
                    $page->content .= '<h1>'.
                        sprintf(
                            $config->getTrans('Entries for'),
                            $wordIndex,
                            $list->lang
                        ).'</h1>';
                }
                foreach ($entry as $subEntry) {
                    $page->content .= $subEntry->getReverse();
                }
            }
        }
    }

    public static function tags($config, $request, &$page)
    {
        $page->content .= '<h1>'.$config->getTrans('tags title').'</h1>';

        if (isset($request->arguments[0]) && isset($config->dictionary->tags[$request->arguments[0]])) {
            $tags[$request->arguments[0]] = $config->dictionary->tags[$request->arguments[0]];
        } else {
            $tags = $config->dictionary->tags;
        }
        foreach($tags as $tag=>$words) {
            foreach($words as $i=>$word) {
                $words[$i] = WorldlangDictUtils::makeLink($config, "leksi/".$word, $word);
            }

            $page->content .= '
                <div class="w3-card">
                <header class="w3-container"><h1>'.$config->dictionary->words[$tag]->term.'</h1></header>
                    <div class="w3-container">';
            if (isset($config->dictionary->words[$tag])) {
                $page->content .= '
                    <p>'.$config->dictionary->words[$tag]->translation[$request->lang].'</p>
                    ';
            }
            if (!empty($words)) {
                $page->content .= '
                    <p class="tags">'.implode(', ', $words).'</p>';
            }
            $page->content .= '
                    </div>
                </div>
                ';
        }
    }
}
