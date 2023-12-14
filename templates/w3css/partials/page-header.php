<?php
namespace WorldlangDict;
?>

<div id="siteHeader">
    <p id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>">
            <span class="fa fa-book fa-lg"></span> <?php echo $config->siteName; ?>
        </a>
    </p>
    <nav>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'abeceli-menalari', $request); ?>"><?= $config->getTrans('browse title') ?></a> &bull;
        <a href="https://xwexi.globasa.net/<?php echo $config->lang;?>/gramati/lexiklase"><?php echo $config->getTrans('word classes link');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexi', $request); ?>"><?php echo $config->getTrans('random word button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a>
    </nav>
    <section class="search">
        <form action="<?php echo WorldlangDictUtils::makeUri($config, "xerca", $request); ?>" method="get">
            <input type="text" name="glb" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" value="" />
            <input type="text" name="<?=$request->lang; ?>" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" value="" />
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" />
        </form>
    </section>


</div>
