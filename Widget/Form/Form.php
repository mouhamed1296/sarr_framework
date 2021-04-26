<?php

namespace App\Widget\Form;

use App\Widget\Models\NormalElement;

class Form extends NormalElement
{

    /**
     * @param string $action
     * @param string $method
     * @param string $class
     */
    public function __construct(string $action = '', string $method = 'get', string $class = '')
    {
        $this->tagName = "form";
        $this->setAttributes(['action' => $action, 'method' => $method, 'class' => $class]);
    }
}
