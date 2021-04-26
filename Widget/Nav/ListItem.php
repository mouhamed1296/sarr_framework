<?php

namespace App\Widget\Nav;

use App\Widget\Models\NormalElement;

final class ListItem extends NormalElement
{
    /**
     * ListItem constructor.
     *
     * @param string $class
     */
    public function __construct(string $class = "")
    {
        $this->tagName = "li";
        $this->attributes['class'] = $class;
    }
}
