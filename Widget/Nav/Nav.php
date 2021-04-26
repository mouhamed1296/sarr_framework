<?php

namespace App\Widget\Nav;

use App\Widget\Models\NormalElement;

class Nav extends NormalElement
{
    /**
     * Menu constructor.
     * @param string $id
     */
    public function __construct($id = "")
    {
        $this->tagName = 'nav';
        $this->attributes['id'] = $id;
    }
}
