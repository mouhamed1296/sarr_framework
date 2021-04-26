<?php

namespace App\Core;

class Debug
{
    public static function showArray(array $array): void
    {
        if (is_array($array)) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        } else {
            echo 'Vous avez passer un argument qui n\'est pas un tableau';
        }
        exit;
    }
    public static function showArrayDump(array $array): void
    {
        if (is_array($array)) {
            echo '<pre>';
            var_dump($array);
            echo '</pre>';
        } else {
            echo 'Vous avez passer un argument qui n\'est pas un tableau';
        }
        exit;
    }
    public static function showObjectDump(object $objet): void
    {
        if (is_object($objet)) {
            echo '<pre>';
            var_dump($objet);
            echo '</pre>';
        } else {
            echo 'Vous avez passer un argument qui n\'est pas un objet';
        }
        exit;
    }
    public static function varDump(bool $exit,...$vars): void
    {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
        if($exit === true) {
            exit;
        }
    }
}
