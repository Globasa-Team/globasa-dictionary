<?php
namespace WorldlangDict;

class Natlang_browse_controller
{
    public static function default(object $config, object $request, object &$page)
    {
        $index = [];
        $page->setTitle("natlang browse title");
        // $dict = yaml_parse_file($config->basic_location.$request->lang.".yaml");
        $index_filename = $config->search_terms_location.$request->lang.".yaml";
        if (file_exists($index_filename)) {
            $index = yaml_parse_file($index_filename);
        }
        require_once('views/natlang_browse_view.php');
    }


}
