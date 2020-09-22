<?php namespace WorldlangDict;

class FeedbackView
{

    public static function new ($config, $request, $page)
    {
        $page->content .= '

        <div class="w3-card">

        <div class="w3-container w3-green">
          <h2>Feedback / Report</h2>
        </div>

        <form
          action="https://formspree.io/maylyonr"
          method="POST"
          class="w3-container"
        >
          <input type="hidden" name="URL" value="'. $request->options['url'] .'" >
          <label>
            <p>Your email:</p>
            <input type="text" name="_replyto" class="w3-input" >
          </label>

          <p>Subject:</p>
          <label><input class="w3-radio" type="radio" name="subject" value="Website error" checked>
          website error</label><br/>

          <label><input class="w3-radio" type="radio" name="subject" value="Suggestion" >
          Suggestion</label><br/>

          <label><input class="w3-radio" type="radio" name="subject" value="Language suggestion">
          Language suggestion</label><br/>

          <label><input class="w3-radio" type="radio" name="subject" value="Other / Not Sure">
          Other</label><br/>

          <label>
            <p>Your message:</p>
            <textarea name="message" class="w3-input" ></textarea>
          </label>

          <div class="feedbackSubmit">
            <button type="submit" class="w3-btn w3-blue">Send</button>
          </div>
        </form>
        </div>
        ';
    }
}
