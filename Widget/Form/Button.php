<?php

namespace App\Widget\Form;

use App\Widget\Models\NormalElement;

class Button extends NormalElement
{
    public function __construct($text = "button", string $type = "button")
    {
        $this->tagName = "button";
        $this->attributes['type'] = $type;
        $this->addText($text);
    }
}
