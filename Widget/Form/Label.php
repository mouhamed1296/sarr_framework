<?php

namespace App\Widget\Form;

use App\Widget\Models\NormalElement;

class Label extends NormalElement
{
    public function __construct($labelText, string $for = '', $class = '')
    {
        $this->tagName = 'label';
        $this->attributes['for'] = $for;
        $this->attributes['class'] = $class;
        $this->addText($labelText);
    }
}
