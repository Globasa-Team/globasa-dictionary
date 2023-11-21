<?php
namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="">
<? require_once("partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>


<!--                  -->
<!-- IPA Conversation -->
<!--                  -->

<main id="content">
  <div class="w3-container" style="padding: 5px">
    <h1><?php echo $config->getTrans('ipa converter title');?></h1>
    <p><?php echo $config->getTrans('ipa converter instructions');?></p>
    <textarea name="globasaInput" id="globasaInput" class="w3-input w3-border w3-light-grey" placeholder="<?php echo $config->getTrans('ipa converter input placeholder');?>"></textarea>

    <button onClick="convertAction()" class="w3-btn w3-green"><?php echo $config->getTrans('ipa converter button');?></button>
    <button onClick="convertSsmlAction()" class="w3-btn w3-blue-grey"><?php echo $config->getTrans('ipa converter-ssml button');?></button>
    
    <p><?php echo $config->getTrans('ipa converter output label');?><p>
    <textarea name="ipaOutput" id="ipaOutput" class="w3-pale-blue" style="white-space: pre-wrap; padding: 5px;" disabled><?php echo $config->getTrans('ipa converter ipa placeholder');?></textarea>
  </div>
</main>




<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
