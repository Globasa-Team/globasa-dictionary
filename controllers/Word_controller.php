<?php
declare(strict_types=1);
namespace WorldlangDict;

use PSpell\Config;

class Word_controller
{
    public static function output_entry(WorldlangDictConfig $config, Request $request, Page &$page)
    {
        if (!isset($request->arguments[0])) self::randomWord($config, $request, $page);
        $slug = mb_strtolower($request->arguments[0], encoding:"UTF-8");
        $file = $config->api2Path.'terms/'.$slug.'.yaml';
        if (!file_exists($file)) throw new Error_404_Exception("Entry Not Found");
        $entry = yaml_parse_file($file);

        $page->setTitle(isset($entry['term_spec']) ? $entry['term_spec'] : $entry['term']);
        
        $examples = null;
        if (!empty($config->examples_location) and file_exists($config->examples_location.$entry['slug'].'.yaml')) {
            $example_data = yaml_parse_file($config->examples_location.$entry['slug'].'.yaml');

            $examples = array();
            $count = 0;
            
            foreach($example_data as $priority_level=>$priority_data) {
                if (count($examples) > ENTRY_EXAMPLES_MAX) break;
                foreach($priority_data as $example) {
                    if (count($examples) > ENTRY_EXAMPLES_MAX) break;

                    $cite = null;
                    if (isset($example['cite']['text'][$request->lang])) {
                        $cite = $example['cite']['text'][$request->lang];
                    } elseif (isset($example['cite']['text'][WL_CODE_SHORT])) {
                        $cite = $example['cite']['text'][WL_CODE_SHORT];
                    } elseif (!empty($example['cite']['text'])) {
                        $cite = array_first($example['cite']['text']);
                    }

                    $link = null;
                    if (isset($example['cite']['link'][$request->lang])) {
                        $link = $example['cite']['link'][$request->lang];
                    } elseif (isset($example['cite']['link'][WL_CODE_SHORT])) {
                        $link = $example['cite']['link'][WL_CODE_SHORT];
                    } elseif (!empty($example['cite']['link'])) {
                        $link = array_first($example['cite']['link']);
                    }

                    if ($cite === null && !empty($link)) {
                        $cite = $link;
                    }
                    $examples[] = ['text'=>$example['text'], 'cite'=>$cite, 'link'=>$link];

                }
            }
        }

        include("views/entry_view.php");
        
    }
    
    /**
     * Show reverse lookup. Eg, searching ENG: child.
     */
    public static function addNatWord(WorldlangDictConfig $config, Request $request, string $lang, Page &$page)
    {
        if (!file_exists($config->search_terms_location.$lang.".yaml"))
            throw new Error_404_Exception("Language not availble");
        
        if (empty($request->arguments[0]))
            WorldlangDictUtils::redirect(config:$config, request:$request);
        $slug = $request->arguments[0];
        
        // Check for translator note, and remove
        if (str_contains($slug, '('))
            $term = mb_trim(mb_substr($slug, 0, mb_strpos($slug, '(')));
        else
            $term = mb_trim($slug);
        
        $search_terms = yaml_parse_file($config->search_terms_location.$lang.".yaml");
        if (!isset($search_terms[$term]))
            throw new Error_404_Exception("Word not found");

        $page->setTitle($term.': '.$config->getTrans('natlang search title bar'));
        $results = &$search_terms[$term];
        require_once("views/search_results_view.php");
    }


    public static function randomWord(WorldlangDictConfig $config, Request $request, Page &$page)
    {
        $index = yaml_parse_file($config->min_location.$config->lang.".yaml");
        $wordIndex = array_rand($index);
        WorldlangDictUtils::redirect(config:$config, request:$request, controller:'word', arg:$wordIndex);
    }
}
