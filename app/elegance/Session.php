<?php

namespace elegance;

/** Camada de gerenciamento de variaveis de sessão */
abstract class Session
{

    /** Adiciona uma variavel de sessão */
    public static function set(string $name, $value = null)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            if (is_object($value)) {
                $value = serialize($value);
            }
            $_SESSION[$name] = $value;
        }
    }

    /** Retorna o valor de uma variavel de sessão */
    public static function get(string $name)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $return = $_SESSION[$name] ?? null;
            if (is_serialized($return)) {
                $return = unserialize($return);
            }
        }
        return $return ?? null;
    }
}

if (isset($_SERVER['HTTP_HOST'])) {
    $cookieTime = env('COOKIE_TIME', 1) * 24 * 60 * 60;

    $char = substr($_SERVER['HTTP_HOST'], 0, 1);

    $sessionName = $_SERVER['REMOTE_ADDR'] . $char . 'SESSIONID';
    $sessionName = cif_on($sessionName, $char);

    session_set_cookie_params($cookieTime, '/', '', true, true);

    session_name(code_on($sessionName));

    session_start();
}
