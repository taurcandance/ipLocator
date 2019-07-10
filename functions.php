<?php

const ENABLE_DEBUG_LOGIN = true;

/**
 * Register autoload for project classes
 *
 */
spl_autoload_register(function ($class_name){
    require_once $class_name.'.php';
});

/**
 * @param string $file_name
 *
 * @return string
 */
function get_full_data_path(string $file_name): string
{
    return __DIR__.'/'.$file_name;
}

/**
 * @param string $string
 *
 * @return void
 */
function debug_log(string $string): void
{
    if(ENABLE_DEBUG_LOGIN) {
        echo $string;
    }
}