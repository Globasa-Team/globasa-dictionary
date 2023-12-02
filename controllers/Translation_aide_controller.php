
<?php
namespace WorldlangDict;

class Translation_aide_controller
{

    public static function run($config, $request, &$page)
    {
        $config->dictionary = unserialize(file_get_contents($config->serializedLocation));
        $bulkWords = Tool::transAideBulkTranslate($config, $request);

        ToolView::transAideTitle($config, $page, $request);
        ToolView::transAideInput($config, $request, $page);
        ToolView::transAideResults($config, $request, $bulkWords, $page);
        
        $page->setTitle($config->getTrans('translation aide title'));
        $page->description = $config->getTrans('translation aide description');
    }

}