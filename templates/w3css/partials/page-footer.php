<?php
namespace WorldlangDict;
?>


<footer id="siteFooter" class="w3-container w3-padding-large w3-light-grey w3-opacity">
    <div class="w3-cell-row">
        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p>C0 <a href="https://www.globasa.net">Globasa.net</a>.<br/>
            A <a href="https://www.partialsolution.ca/">Partial Solution</a>.</p>
        </div>
        <div class="w3-container w3-cell w3-mobile" style="text-align: center;">
        <?php
        $firstLang = true;
        foreach($config->userLangs as $curLang=>$curName) {
            $uri = WorldlangDictUtils::changeLangUri($config, $request, $curLang);
            if (!$firstLang) echo " &bull; ";
            else $firstLang = false;
            echo "<a href=\"{$uri}\">{$curName}</a>";
        } ?>
        </div>

        <div class="w3-container w3-cell w3-mobile" style="width: 10%;">
            <p><a href="https://www.globasa.net/" class="w3-button"><span class="fa fa-link"></span> <?php echo $config->getTrans('globasa link');?></a><br/>
            <a href="https://github.com/ShawnPConroy/WorldlangDict" class="w3-button"><span class="fa fa-github"></span> <?php echo $config->getTrans('github link');?></a><br/>
            <a href="<?php echo WorldlangDictUtils::makeUri(
    $config,
    'am-reporte/?url='.$config->siteUri.substr($request->url, 1),
    $request
); ?>" class="w3-button"><span class="fa fa-bug"></span> <?php echo $config->getTrans('report link');?></a><br/>
            <a href="https://api.globasa.net/" class="w3-bar-item w3-button"><span class="fa fa-code"></span> <?php echo $config->getTrans('api link');?></a></p>
        </div>
    </div>
</footer>
<!-- 
  <script src="<?php echo $config->templateUri; ?>js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
 -->
</body>

</html>
