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

if (!function_exists('table_path')) {

    function table_path($path = '')
    {
        return joinPaths(__DIR__, $path);
    }
}

if (!function_exists('table_route')) {

    function table_route($file)
    {
        return table_path("routes") . DIRECTORY_SEPARATOR . $file;
    }
}

