<?php namespace WorldlangDict;

class FeedbackController
{

    public static function feedback($config, $request, $page)
    {
        FeedbackView::new($config, $request, $page);
    }
}
