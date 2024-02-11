<?;

namespace WorldlangDict;

?>
<section class="translation">
    <p><?

if (!empty($entry['trans'][$request->lang])):
    $gstart = true;
    
    foreach($entry['trans'][$request->lang] as $group):
        if (!$gstart) :
            ?>; <?
        endif;
        $gstart = false;
        $tstart = true;
        
        
        foreach($group as $translation):
            if (!$tstart) :
                ?>, <?
            endif;
            $tstart = false;
            $trans_note_preceeding = '';
            $trans_note_following = '';

            // var_dump($translation);
            // Check for preceeding translation note using colon
            // if ($pos = strpos($translation, ':') !== false) {
            //     $trans_note_preceeding = trim(substr($translation, 0, $pos));
            //     $translation = trim(substr($translation, $pos));
            // }
            
            $slug = trim(strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation))));  // regex removes parentheticals (...)


            if (!str_contains($translation, '<a')) :
                echo($trans_note_preceeding.' ');
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'cel-ruke/'.$slug, $request) ?>" class="hl green"><?=$translation?></a><?
                echo(' '.$trans_note_following);
            else:
                ?><span class="hl"><?=$translation?></span><?
        endif;
        endforeach;
    endforeach;
else:
    echo(sprintf($config->getTrans("Missing Word Translation")));
endif;

?></p>
</section>
