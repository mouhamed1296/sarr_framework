<?php

namespace App\Widget;

use App\Widget\Models\NormalElement;

class Div extends NormalElement
{
    public function __construct(string $class = "")
    {
        $this->attributes['class'] = $class;
        $this->tagName = "div";
    }
}
