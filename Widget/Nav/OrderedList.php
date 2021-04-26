<?php

namespace App\Widget\Nav;

use App\Widget\Models\NormalElement;

class OrderedList extends NormalElement
{

    /**
     * __construct
     *
     * @param string $class
     *
     * @return void
     */
    public function __construct(string $class = '')
    {
        $this->tagName = "ol";
        $this->attributes['class'] = $class;
    }
}
