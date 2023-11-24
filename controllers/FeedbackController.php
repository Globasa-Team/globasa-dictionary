<?php namespace WorldlangDict;

class FeedbackController
{
    public static function feedback($config, $request, $page)
    {
        FeedbackView::feedback($config, $request, $page);
        include_once($config->templatePath.'view-default.php');
    }
}
