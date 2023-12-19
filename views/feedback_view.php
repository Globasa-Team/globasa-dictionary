<?php namespace WorldlangDict;
/*
if (is_string($request)) {
  @error_log("\n\n-----".date(DATE_ATOM)."\n", 3, "debug.log");
  @error_log("\FeedbackView has a request as string.\n", 3, "debug.log");
  @error_log("\nrequest:\n".serialize($request)."\n", 3, "debug.log");
  @error_log("\nbacktrace:\n".serialize(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))."\n", 3, "debug.log");

  foreach(debug_backtrace() as $trace) {
      
      @error_log("\nfile :".$trace['file']."\n", 3, "debug.log");
      @error_log("\nfile :".$trace['class'].$trace['type'].$trace['function'].$trace['line']."\n", 3, "debug.log");
  }
}
*/
?>
<!doctype html>
<html class="no-js" lang="">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body id="htmlBody">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>

<header>
  <h2><?=$config->getTrans('feedback title');?></h2>
</header>

<form
  action="https://formspree.io/maylyonr"
  method="POST"
>
  <input type="hidden" name="URL" value="<?=$request->options['url'];?>" >
  <label>
    <p><?=$config->getTrans('email?');?></p>
    <input type="text" name="_replyto">
  </label>

  <p><?=$config->getTrans('subject?');?></p>
  <label><input type="radio" name="subject" value="<?=$config->getTrans('feedback site error');?>" checked>
  <?=$config->getTrans('feedback site error');?></label><br/>

  <label><input type="radio" name="subject" value="<?=$config->getTrans('feedback lang sug');?>">
  <?=$config->getTrans('feedback lang sug');?></label><br/>

  <label><inputtype="radio" name="subject" value="<?=$config->getTrans('feedback other');?>">
  <?=$config->getTrans('feedback other');?></label><br/>

  <label>
    <p><?=$config->getTrans('message?');?></p>
    <textarea name="message"></textarea>
  </label>

  <div class="feedbackSubmit">
    <button type="submit"><?=$config->getTrans('feedback send button');?></button>
  </div>
</form>
</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
