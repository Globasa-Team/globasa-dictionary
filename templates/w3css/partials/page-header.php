<?php
namespace WorldlangDict;
?>

<div id="siteHeader">
    <h1 id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>">
            <span class="fa fa-book fa-lg"></span> <?php echo $config->siteName; ?>
        </a>
    </h1>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexi', $request); ?>"><?php echo $config->getTrans('random word button');?></a> &bull;
        <a href="https://xwexi.globasa.net/<?php echo $config->lang;?>/gramati/lexiklase"><?php echo $config->getTrans('word classes link');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/trasbasatul', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'abeceli-menalari', $request); ?>"><?= $config->getTrans('browse title') ?></a> &bull;
        
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a>
    <form action="<?php echo WorldlangDictUtils::makeUri($config, "xerca", $request); ?>" method="get">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell">
            <input type="text" name="wTerm" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['wterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell">
            <input type="text" name="nTerm" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" class="w3-input w3-border" value="<?php if (!empty($request->options['wterm'])) {
    echo $request->options['nterm'];
} ?>" />
        </div>
        <div class="w3-container w3-cell w3-cell-middle">
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" class="w3-btn" />
        </div>
    </div>
    </form>


</div>
