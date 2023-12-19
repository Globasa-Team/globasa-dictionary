<?php
namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>


<!--                  -->
<!-- IPA Conversation -->
<!--                  -->

<main>
  <div>
    <h1><?php echo $config->getTrans('ipa converter title');?></h1>
    <p><?php echo $config->getTrans('ipa converter instructions');?></p>
    <textarea name="globasaInput" id="globasaInput" placeholder="<?php echo $config->getTrans('ipa converter input placeholder');?>"></textarea>

    <button onClick="convertAction()"><?php echo $config->getTrans('ipa converter button');?></button>
    <button onClick="convertSsmlAction()"><?php echo $config->getTrans('ipa converter-ssml button');?></button>
    
    <p><?php echo $config->getTrans('ipa converter output label');?><p>
    <textarea name="ipaOutput" id="ipaOutput" style="white-space: pre-wrap; padding: 5px;" disabled><?php echo $config->getTrans('ipa converter ipa placeholder');?></textarea>
  </div>
</main>




<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
