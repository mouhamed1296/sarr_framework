<?php

namespace App\Widget;

use App\Widget\Models\NormalElement;
use App\Widget\Models\VoidElement;

class TagBuilder
{
    private static array $voidElements = [
        "area",
        "base",
        "br",
        "col",
        "embed",
        "hr",
        "img",
        "input",
        "link",
        "meta",
        "param",
        "source",
        "track",
        "wbr"
    ];


    /**
     * Cre
     *
     * @param string $tagName l
     *
     * @return VoidElement
     */
    public static function createVoidElement(string $tagName): VoidElement
    {
        return new class ($tagName) extends VoidElement {

            /**
             *  Constructor.
             *
             * @param string $tagName l
             */
            public function __construct(string $tagName)
            {
                $this->tagName = $tagName;
            }
        };
    }

    /**
     * Cre
     *
     * @param string $tagName the name of the tag you want to create
     *
     * @return NormalElement
     */
    public static function createNormalElement(string $tagName): NormalElement
    {
        return new class ($tagName) extends NormalElement {

            /**
             *  Constructor.
             *
             * @param string $tagName l
             */
            public function __construct(string $tagName)
            {
                $this->tagName = $tagName;
            }
        };
    }

    public static function createElement(string $tagName)
    {
        if (in_array($tagName, self::$voidElements)) {
            self::createVoidElement($tagName);
        } else {
            self::createNormalElement($tagName);
        }
    }
}
