<?php

namespace elegance;

/** Manipula cookies do projeto */
abstract class Cookie extends Session
{

    /** Lista de cookies controlados */
    protected static $cookies = [];

    /** Lista de cookies removidos na requisição */
    protected static $unlinked = [];

    /**
     * Manipula o valor de um cookie
     * @param string $name Nome do cookie que deve ser manitupado
     * @param string $value Valor que deve ser atribuído ao cookie
     * Atribuit um valor nulo, excluirá o cookie
     */
    public static function set(string $name, $value = null)
    {
        $protected = substr($name, 0, 1) == '#';

        if ($protected) {
            $name = code_on("COOKIE_$name");
            $value = self::valueEncode($value);
        }

        self::$cookies[$name] = $value;
        if (is_null($value)) {
            self::$unlinked[$name] = true;
            self::phpSet($name, $value, time() - 3600);
            return null;
        }
        if (isset(self::$unlinked[$name])) {
            unset(self::$unlinked[$name]);
        }
        self::phpSet($name, $value);
    }

    /** Captura o valor de um cookie */
    public static function get(string $name)
    {
        $protected = substr($name, 0, 1) == '#';

        if ($protected) {
            $name = code_on("COOKIE_$name");
        }

        if (isset(self::$unlinked[$name])) {
            return null;
        }

        if (!isset(self::$cookies[$name])) {
            self::$cookies[$name] = self::phpGet($name);
        }

        $value = self::$cookies[$name];

        if ($protected) {
            $value = self::valueDecode($value);
        }

        return $value;
    }

    #==| |==#

    /** Codifica uma variavel para ser escrita em cookie */
    protected static function valueEncode($value)
    {
        switch (gettype($value)) {
            case 'boolean':
                $value = "b:" . intval($value);
                break;
            case 'integer':
                $value = "i:" . intval($value);
                break;
            case 'double':
                $value = "f:$value";
                break;
            case 'array':
                $value = "a:" . json_encode($value);
                break;
            case 'NULL':
                $value = "n:";
                break;
            default:
                $value = "::$value";
                break;
        }
        return cif_on($value);
    }

    /** Decodifica uma variavel escrita em cookie para o valor normal */
    protected static function valueDecode($value)
    {
        if (is_string($value)) {
            $value = cif_off($value);
            $type = substr($value, 0, 2);
            $value = substr($value, 2);
            switch ($type) {
                case 'b:':
                    $value = boolval($value);
                    break;
                case 'i:':
                    $value = intval($value);
                    break;
                case 'f:':
                    $value = floatval($value);
                    break;
                case 'a:':
                    $value = json_decode($value, true);
                    break;
                case 'n:':
                    $value = null;
                    break;
                default:
                    $value = $value;
                    break;
            }
        }
        return $value;
    }

    /** Altera o valor de um cookie real do PHP */
    protected static function phpSet($name, $value, $time = 0)
    {
        setcookie($name, $value, $time, '/');
        $_COOKIE[$name] = $_COOKIE[$name] ?? $value;
    }

    /** Captura o valor de um cookie real do PHP */
    protected static function phpGet($name)
    {
        return filter_input(INPUT_COOKIE, $name);
    }
}
