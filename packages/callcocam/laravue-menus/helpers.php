<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */


if (!function_exists('joinPaths')) {
    function joinPaths($basePath, $path = '')
    {
        return $basePath . ($path != '' ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : '');
    }
}

if (!function_exists('menu_path')) {

    function menu_path($path = '')
    {
        return joinPaths(__DIR__, $path);
    }
}

if (!function_exists('menu_route')) {

    function menu_route($file)
    {
        return menu_path("routes") . DIRECTORY_SEPARATOR . $file;
    }
}

