<?php

namespace App\Widget\Form;

use App\Widget\Models\NormalElement;

class Option extends NormalElement
{
    public function __construct($value)
    {
        $this->tagName = "option";
        $this->attributes['value'] = $value;
        $this->addText(ucfirst($value));
    }
}
