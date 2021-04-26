<?php

namespace App\Core;

class View
{
    public static string $content = '';

    private function __construct(){/* Can't be instantiated outside the class */}

    /**
     * @return string
     */
    public static function getContent(): string
    {
        return self::$content;
    }

    /**
     * @param string $content
     */
    public static function setContent(string $content): void
    {
        self::$content = $content;
    }
}