<?php
namespace WorldlangDict;

class Error_controller
{
    public static function error_404(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function invalid_request(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function data_error(object $config, object $request, object $page):void {
        include_once('views/error_404_view.php');
    }

    public static function wtf(object $config, object $request, object $page):void {
        include_once('views/error_wtf_view.php');
    }
}