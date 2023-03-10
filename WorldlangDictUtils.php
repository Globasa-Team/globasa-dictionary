<?php
namespace WorldlangDict;

class WorldlangDictUtils
{
    public static function makeUri($config, $controller, $request)
    {
        if (is_string($request)) {
            @error_log("\n\n-----".date(DATE_ATOM)."\n", 3, "debug.log");
            @error_log("\nmakeUri has a request as string.\n", 3, "debug.log");
            @error_log("\nrequest:\n".serialize($request)."\n", 3, "debug.log");
            @error_log("\nbacktrace:\n".serialize(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))."\n", 3, "debug.log");
    

            foreach($_SERVER as $key=>$cur) {
                if (!in_array($key, ["UNIQUE_ID", "SCRIPT_URI", "REQUEST_URI", "SCRIPT_NAME", "REDIRECT_UNIQUE_ID", "REDIRECT_SCRIPT_URL", "REDIRECT_SCRIPT_URI", "REDIRECT_URL", "REDIRECT_QUERY_STRING"])) continue;
                if (is_string($cur)){
                    @error_log("\n_SERVER[{$key}]: ".serialize($cur)."\n", 3, "debug.log");
                } else {
                    @error_log("\n_SERVER[{$key}]: ".$cur."\n", 3, "debug.log");
                }
            }

            foreach(debug_backtrace() as $trace) {
                
                @error_log("\nfile :".$trace['file']."\n", 3, "debug.log");
                @error_log("\nfile :".$trace['class'].$trace['type'].$trace['function'].$trace['line']."\n", 3, "debug.log");
            }
        }
        return $config->siteUri.$config->lang.'/'.$controller.(!is_string($request) ? $request->linkQuery : "");
    }

    public static function changeLangUri($config, $request, $lang)
    {
        if (is_null($request->arguments)) {
            $args = '';
        } elseif (sizeof($request->arguments) == 1) {
            $args = $request->arguments[0];
        } else {
            $args = implode('/', $request->arguments);
        }
        return $config->siteUri.$lang.'/'
            .$request->controller.'/'
            .$args
            .$request->linkQuery;
    }

    public static function redirect($config, $request, $controller="")
    {
    
        if (is_string($request)) {
            
            @error_log("\n\n-----".date(DATE_ATOM)."\n", 3, "debug.log");
            @error_log("\nredirect on request:\n".serialize($request)."\n", 3, "debug.log");
            @error_log("\n_SERVER: ".$_SERVER["REQUEST_URI"]."\n", 3, "debug.log");
            @error_log("\n_SERVER: ".$_SERVER["SCRIPT_NAME"]."\n", 3, "debug.log");
            @error_log("\n_SERVER: ".$_SERVER["PHP_SELF"]."\n", 3, "debug.log");
            @error_log("\n_SERVER: ".$_SERVER["SCRIPT_URI"]."\n", 3, "debug.log");
            foreach($_REQUEST as $key=>$cur) {
                if (is_string($cur)){
                    @error_log("\n_REQUEST[{$key}]: ".serialize($cur)."\n", 3, "debug.log");
                } else {
                    @error_log("\n_REQUEST[{$key}]: ".$cur."\n", 3, "debug.log");
                }
            }
            
            foreach($_SERVER as $key=>$cur) {
                if (is_string($cur)){
                    @error_log("\n_SERVER[{$key}]: ".serialize($cur)."\n", 3, "debug.log");
                } else {
                    @error_log("\n_SERVER[{$key}]: ".$cur."\n", 3, "debug.log");
                }
            }
        }

        header('Location: '.WorldlangDictUtils::makeUri($config, $controller, $request));
        exit(0);
    }

    public static function makeLink($config, $controller, $request, $text=null)
    {
        if ($text == null) {
            $text = $controller;
        }
        return '<a href="'.
            WorldlangDictUtils::makeUri($config, $controller, $request).
            '">'.$text.'</a>';
    }
}
