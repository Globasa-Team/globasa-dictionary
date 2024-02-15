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
            if (($pos = strpos($translation, ':')) !== false) {
                $trans_note_preceeding = trim(substr($translation, 0, $pos+1));
                $translation = trim(substr($translation, $pos+1));
            }
            
            $slug = trim(strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation))));  // regex removes parentheticals (...)

            // TODO: link this!
            if (!str_contains($translation, '<a')) :
                echo($trans_note_preceeding.' ');
                ?><a href="<?= WorldlangDictUtils::makeUri($config, 'cel-ruke/'.$slug, $request) ?>" class="hl green"><?=$translation?></a><?
                echo(' '.$trans_note_following);
            else:
                ?><span class="hl green"><?=$translation?></span><?
            endif;
        endforeach;
    endforeach;
elseif (!isset($entry['entry note beta'])):
    echo(sprintf($config->getTrans("Missing Word Translation")));
endif;

?></p>


<?
if (isset($entry['entry note beta'])) : ?>
    <p><?= $entry['entry note beta']; ?></p>
<? endif; ?>


<?
if (isset($entry['entry notes'])) :
    foreach ($entry['entry notes'] as $type=>$data) :
        switch ($type) :
            case 'Am oko tabellexi':
                ?>  <p><?= $config->getTrans('entry nota Am oko tabellexi'); ?></p><?
                break;
            case 'Am oko':
            case 'Kurto lexi cel':
            case 'Am kompara fe':
            case 'Yongudo sol ton':
                ?>  <p><?= $config->getTrans('entry nota '.$type); ?>: <?
                $nfirst = true;
                foreach ($entry['entry notes'][$type] as $slug) :
                    if (!$nfirst) {
                        echo(", ");
                    } else {
                        $nfirst = false;
                    }
                    ?>  <a href="<?= WorldlangDictUtils::makeUri($config, 'lexi/'.$slug, $request); ?>" lang="<?= GLB_CODE; ?>"><?= $slug; ?></a><?
                endforeach;
                ?>.</p><?
                break;
            case 'Nota':
                ?>  <p><?= $entry['entry notes'][$type]; ?></p>  <?
                break;
        endswitch;
    endforeach;
endif;


?>


</section>
