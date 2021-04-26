<?php

namespace App\Widget\Scripts;

use App\Widget\Models\NormalElement;

class Script extends NormalElement
{
    public function __construct(?string $src = null, ?string $content = null)
    {
        $this->tagName = "script";
        if (!is_null($src)) 
            $this->setAttribute('src', $src);
        $this->addText($content);
    }
}
