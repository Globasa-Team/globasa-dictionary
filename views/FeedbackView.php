<?php namespace WorldlangDict;

class FeedbackView
{
    public static function feedback($config, $request, $page)
    {


      if (is_string($request)) {
        error_log("\n\n-----".date(DATE_ATOM)."\n", 3, "debug.log");
        error_log("\FeedbackView has a request as string.\n", 3, "debug.log");
        error_log("\nrequest:\n".serialize($request)."\n", 3, "debug.log");
        error_log("\nbacktrace:\n".serialize(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))."\n", 3, "debug.log");

        foreach(debug_backtrace() as $trace) {
            
            error_log("\nfile :".$trace['file']."\n", 3, "debug.log");
            error_log("\nfile :".$trace['class'].$trace['type'].$trace['function'].$trace['line']."\n", 3, "debug.log");
        }
    }







        $page->content .= '

        <div class="w3-card">

        <header>
          <div class="w3-container">
          <h2>'.$config->getTrans('feedback title').'</h2>
          </div>
        </header>

        <div class="w3-container">
        <form
          action="https://formspree.io/maylyonr"
          method="POST"
          class="w3-container"
        >
          <input type="hidden" name="URL" value="'. $request->options['url'] .'" >
          <label>
            <p>'.$config->getTrans('email?').'</p>
            <input type="text" name="_replyto" class="w3-input" >
          </label>

          <p>'.$config->getTrans('subject?').'</p>
          <label><input class="w3-radio" type="radio" name="subject" value="'.$config->getTrans('feedback site error').'" checked>
          '.$config->getTrans('feedback site error').'</label><br/>

          <label><input class="w3-radio" type="radio" name="subject" value="'.$config->getTrans('feedback lang sug').'">
          '.$config->getTrans('feedback lang sug').'</label><br/>

          <label><input class="w3-radio" type="radio" name="subject" value="'.$config->getTrans('feedback other').'">
          '.$config->getTrans('feedback other').'</label><br/>

          <label>
            <p>'.$config->getTrans('message?').'</p>
            <textarea name="message" class="w3-input" ></textarea>
          </label>

          <div class="feedbackSubmit">
            <button type="submit" class="w3-btn">'.$config->getTrans('feedback send button').'</button>
          </div>
        </form>
        </div>
        </div>
        ';
    }
}
