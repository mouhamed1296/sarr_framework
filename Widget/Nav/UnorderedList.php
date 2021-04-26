<?php

namespace App\Widget\Nav;

use App\Widget\Models\NormalElement;

class UnorderedList extends NormalElement
{
    public function __construct(string $class = '')
    {
        $this->tagName = "ul";
        $this->attributes['class'] = $class;
    }
}
