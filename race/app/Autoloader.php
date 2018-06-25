<?php
namespace app;
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $path = str_replace('\\', '/', $class). '.php';
            require_once $path;
        });
    }
}