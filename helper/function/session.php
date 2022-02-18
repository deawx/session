<?php

if (!function_exists('session')) {

    /** Manipula uma variavel de sessão */
    function session(string $name)
    {
        if (func_num_args() > 1) {
            \elegance\Session::set($name, func_get_arg(1));
        }
        return \elegance\Session::get($name);
    }
}

if (!function_exists('session_check')) {

    /** Verifica se uma variavel de sessão existe ou se tem um valor igual ao fornecido */
    function session_check(string $name)
    {
        if (func_num_args() > 1) {
            return boolval(\elegance\Session::get($name) == func_get_arg(1));
        } else {
            return !is_null(\elegance\Session::get($name));
        }
    }
}

if (!function_exists('session_set')) {

    /** Define um valor para uma variavel de sessão */
    function session_set(string $name, $value = null)
    {
        return \elegance\Session::set($name, $value);
    }
}

if (!function_exists('session_get')) {

    /** Retorna o valor de uma variavel de sessão */
    function session_get(string $name)
    {
        return \elegance\Session::get($name);
    }
}

if (!function_exists('session_remove')) {

    /** Remove uma variavel de sessão */
    function session_remove(string $name)
    {
        return \elegance\Session::set($name, null);
    }
}
