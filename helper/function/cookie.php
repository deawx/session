<?php

if (!function_exists('cookie')) {

    /** Manipula um cookie */
    function cookie(string $name)
    {
        if (func_num_args() > 1) {
            \elegance\Cookie::set($name, func_get_arg(1));
        }
        return \elegance\Cookie::get($name);
    }
}

if (!function_exists('cookie_check')) {

    /** Verifica se um cookie existe ou se tem um valor igual ao fornecido */
    function cookie_check(string $name)
    {
        if (func_num_args() > 1) {
            return boolval(\elegance\Cookie::get($name) == func_get_arg(1));
        } else {
            return !is_null(\elegance\Cookie::get($name));
        }
    }
}

if (!function_exists('cookie_set')) {

    /** Define um valor para um cookie */
    function cookie_set(string $name, $value = null)
    {
        return \elegance\Cookie::set($name, $value);
    }
}

if (!function_exists('cookie_get')) {

    /** Retorna o valor de um cookie */
    function cookie_get(string $name)
    {
        return \elegance\Cookie::get($name);
    }
}

if (!function_exists('cookie_remove')) {

    /** Remove um cookie */
    function cookie_remove(string $name)
    {
        return \elegance\Cookie::set($name, null);
    }
}
