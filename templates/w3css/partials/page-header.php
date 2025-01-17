<?php
namespace WorldlangDict;
?>

<div id="siteHeader">
    <p id="appTitle">
        <a href="<?php echo WorldlangDictUtils::makeUri($config, '', $request); ?>">
        <?php echo $config->getTrans('site_name_short');  /* TODO removed fontawesome icon */?>
        </a>
    </p>
    <nav>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'abeceli-menalari', $request); ?>"><?= $config->getTrans('browse title') ?></a> &bull;
<?php /* TODO removed xwexi link */ ?>
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'estatisti-fe-lexiasel', $request); ?>"><?php echo $config->getTrans('natlangs title');?></a> &bull;
        <a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexi', $request); ?>"><?php echo $config->getTrans('random word button');?></a>
<? if ($request->lang === 'eng') : ?>
        &bull; <a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a>
<? endif; ?>
    </nav>
    <section class="search">
        <form action="<?php echo WorldlangDictUtils::makeUri($config, "xerca", $request); ?>" method="get">
            <input type="text" name="glb" placeholder="<?php echo $config->getTrans('search worldlang placeholder');?>" value="" />
            <input type="text" name="<?=$request->lang; ?>" placeholder="<?php echo $config->getTrans('search natlang placeholder');?>" value="" />
            <input type="submit" value="<?php echo $config->getTrans('search button');?>" />
        </form>
    </section>


</div>
