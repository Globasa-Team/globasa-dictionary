<?php
namespace WorldlangDict;

/**
 * Calls the appropriate function based on the url.
 */
class Request
{
    public $lang, $controller, $options, $arguments, $incomplete;
    private $path, $linkQuery;
    
    function __construct($app) {
        
        $parsedUrl = parse_url(strtolower($_SERVER['REQUEST_URI']));
        $this->path = explode('/', $parsedUrl['path']);
        
        if (isset($parsedUrl['query'])) {
            $this->linkQuery = '?'.$parsedUrl['query'];
            parse_str($parsedUrl['query'], $this->options);
        } else {
            $this->linkQuery = null;
            $this->options = null;
        }
        
        // Find num of parameters by comparing path to URI (minus 3 for domain)
        $requestSize = sizeof($this->path);
        if (empty($this->path[$requestSize-1])) {
            $requestSize -= 1;
        }
        $requestSkip = sizeof(explode('/', $app->siteUri))-3;
        $requestSize = $requestSize-$requestSkip;
        
        // Let's get to the request content!
        $this->lang = $app->lang;
        $this->controller = 'leksi';
        $this->arguments = null;
        
        if ($requestSize >= 1) {
            $this->lang = $this->path[$requestSkip];
            if ($requestSize >= 2) {
                $this->controller = $this->path[$requestSkip+1];
                if ($requestSize >= 3) {
                    for ($i = 2; $i < $requestSize; $i++) {
                        $this->arguments[$i-2] = urldecode($this->path[$requestSkip+$i]);
                    }
                }
            }
        }
        
        if ($requestSize <= 1) {
            $this->incomplete = true;
            // header("Location: ".$app->siteUri.$app->lang.'/words');
            // exit();
        }
        else {
            $this->incomplete = false;
        }
    
    }
}