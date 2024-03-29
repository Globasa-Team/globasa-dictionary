<?php
namespace WorldlangDict;

class Translation_aid_controller
{

    public static function default($config, $request, &$page)
    {
        // $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $dict = yaml_parse_file($config->basic_location.$request->lang.'.yaml');
        $sentences = Translation_aid::transAideBulkTranslate($config, $request);
        $page->setTitle($config->getTrans('translation aide title'));
        $page->description = $config->getTrans('translation aide description');
        require_once('views/translation_aid_view.php');
    }

}