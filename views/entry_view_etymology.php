<?;

namespace WorldlangDict;

?>
<section class="etymology">
<h2><?= sprintf($config->getTrans('Etymology'), "")?></h2>
<?

// A priori
if (!empty($entry['etymology']['a priori'])): ?>
    <p class="apriori"><em>a priori</em></p>
<? endif;



// Derived
if (isset($entry['etymology']['derived trans'])): ?>
<div class="derived">
    
    <?
foreach($entry['etymology']['derived trans'] as $data) :
    if ($data['text'] === '+') :
        ?> + <?
    elseif ($data['text'] === ',') :
        ?>, <?
    else :
        ?><a href="../lexi/<?= $data['text']; ?>"><?= $data['text']; ?></a><?
    endif;
endforeach;
?> <details><summary class="hide"><span class="hl green">[+]</span></summary>
<dl>
<? foreach($entry['etymology']['derived trans'] as $data) :
    if ($data['text'] !== '+' && $data['text'] !== ',') : ?>
        <div>
        <dt><?=WorldlangDictUtils::makeLink(
                    $config,
                    'lexi/'.$data['text'],
                    $request,
                    $data['text']
                );?></dt>
        <dd>
        <? if (isset($data['word class'])) : ?>
            <em>(<a href="https://xwexi.globasa.net/<?=$request->lang;?>/gramati/lexiklase"><?=$data['word class'];?></a>)</em>&nbsp;
        <? endif; ?>
            <?=$data['trans'][$request->lang];?>
        </dd>

        </div>
        
        <?
    endif;
endforeach; ?>
</dl>
</details>
</div>
<? endif;



// Natlang
if (isset($entry['etymology']['natlang'])): ?>
<div class="natlang">
<?
    $list = &$entry['etymology']['natlang'];
    include($config->templatePath . "partials/entry_language_list.php");
?>
</div>
<? endif; ?>

<?
// kwasilexi
if (isset($entry['etymology']['kwasilexi'])): ?>
<div class="kwasilexi">
    <h3>Kwasilexi</h3>
    <? $list = &$entry['etymology']['kwasilexi'];
    include($config->templatePath . "partials/entry_language_list.php"); ?>
</div>
<? endif;

// am oko pia
// TODO: Remove when am oko pia removed from spreadsheet.
if (isset($entry['etymology']['am oko pia'])): ?>
<div>
    <h3>Am oko pia</h3>
    <ul>
    <? foreach($entry['etymology']['am oko pia'] as $item): ?>
        <li class="hl encap"><?=$item;?></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;

// am oko
if (isset($entry['etymology']['am oko'])): ?>
<div>
    <h3>Am oko</h3>
    <ul>
    <? foreach($entry['etymology']['am oko'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;

// am kompara
if (isset($entry['etymology']['am kompara'])): ?>
<div>
    <h3>Am kompara</h3>
    <ul>
    <? foreach($entry['etymology']['am kompara'] as $item): ?>
        <li><a href="../lexi/<?=$item;?>" class="hl encap" lang="<?=GLB_CODE;?>"><?=$item;?></a></li>
    <? endforeach; ?>
    </ul>
</div>
<? endif;


// link
if (isset($entry['etymology']['link'])): ?>
<p><?= $config->getTrans('etymology link') ?></p>
<p><a href="<?=$entry['etymology']['link']?>"><?=$entry['etymology']['link']?></a></p>
<? endif; ?>

</section>