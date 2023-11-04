<?php namespace WorldlangDict;

class FeedbackController
{
    public static function feedback($config, $request, $page)
    {
        $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        FeedbackView::feedback($config, $request, $page);
        include_once($config->templatePath.'view-default.php');
    }
}
