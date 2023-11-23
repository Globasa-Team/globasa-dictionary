<?php
namespace WorldlangDict;
?>


<footer id="siteFooter" class="">
    <section class="langs">
        <?php
        $firstLang = true;
        foreach($config->userLangs as $curLang=>$curName) {
            $uri = WorldlangDictUtils::changeLangUri($config, $request, $curLang);
            if (!$firstLang) echo " &bull; ";
            else $firstLang = false;
            echo "<a href=\"{$uri}\">{$curName}</a>";
        } ?>
    </section>

    <section class="about">
            <img src="https://cdn.globasa.net/logo/glb_flower_transparent_44.webp" alt="Globasa Logo" />
            <p>Menalari fe Globasa<br/>
            <em>Basa de Globayen</em></p>
    </section>

    <section><ul>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'abeceli-menalari', $request); ?>"><?= $config->getTrans('browse title') ?></a></li>
        <li><a href="https://xwexi.globasa.net/<?php echo $config->lang;?>/gramati/lexiklase"><?php echo $config->getTrans('word classes link');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexilari', $request); ?>"><?php echo $config->getTrans('all words button');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul/basatayti', $request); ?>"><?php echo $config->getTrans('translation aide title');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'lexi', $request); ?>"><?php echo $config->getTrans('random word button');?></a></li>
        <li><a href="<?php echo WorldlangDictUtils::makeUri($config, 'tul', $request); ?>"><?php echo $config->getTrans('tools button');?></a></li>
    </ul></section>
    
    <section><ul>
        <li><a href="https://globasa.net/eng/">🔗 Globasa</a></li>
        <li><a href="https://xwexi.globasa.net/eng/">🔰 Xwexi</a></li>
        <li><a href="https://doxo.globasa.net/eng/">📖 Doxo</a></li>
        <li><a href="https://menalari.globasa.net/eng/">📔 Menalari</a></li>
    </ul></section>

    <section><ul>
            <li><a href="https://github.com/Globasa-Team/globasa-dictionary"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a></li>
            <li><a href="<?php echo WorldlangDictUtils::makeUri(
                        $config,
                        'am-reporte/?url='.$config->siteUri.substr($request->url, 1),
                        $request
                    ); ?>"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a></li>
            <li><a href="https://api.globasa.net/"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a></li>
    </ul></section>

    <section class="copyright">  
        <a xmlns:dct="http://purl.org/dc/terms/" rel="license" class="cc_license badge"
            href="http://creativecommons.org/publicdomain/zero/1.0/">
            <img src="https://xwexi.globasa.net/user/themes/globasa-learn2-theme/images/cc_blue_x2.png" alt="CC0" class="cc_license"/>
            <img src="https://xwexi.globasa.net/user/themes/globasa-learn2-theme/images/zero_blue_x2.png" alt="CC0" class="cc_license"/>
        </a>
        <p xmlns:dct="http://purl.org/dc/terms/" class="cc_license">
            To the extent possible under law, <a rel="dct:publisher" href="https://globasa.net/"><span property="dct:title">the Globasa Team</span></a> has waived all copyright and related or neighboring rights to this site content. Built on a <a href="https://partialsolution.ca">Partial Solution</a>.
        </p>
    </section>

</footer>
<!-- 
  <script src="<?php echo $config->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
 -->
