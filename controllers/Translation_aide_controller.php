<?php
namespace WorldlangDict;

class Translation_aid_controller
{

    public static function default($config, $request, &$page)
    {
        // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $dict = yaml_parse_file($config->min_location.$request->lang.'.yaml');
        $sentences = Translation_aid::transAideBulkTranslate($config, $request);
        $page->setTitle($config->getTrans('translation aide title'));
        $page->description = $config->getTrans('translation aide description');
        include('views/Translation_aid_view.php');
    }

}