<?php namespace WorldlangDict;

class FeedbackController
{

    public static function feedback($config, $request, $page)
    {
        FeedbackView::feedback($config, $request, $page);
    }
}
