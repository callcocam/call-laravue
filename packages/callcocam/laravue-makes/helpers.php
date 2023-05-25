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

if (!function_exists('make_path')) {

    function make_path($path = '')
    {
        return joinPaths(__DIR__, $path);
    }
}

if (!function_exists('make_route')) {

    function make_route($file)
    {
        return make_path("routes") . DIRECTORY_SEPARATOR . $file;
    }
}

