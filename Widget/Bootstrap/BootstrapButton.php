<?php

namespace App\Widget\Bootstrap;

use App\Widget\Models\NormalElement;
use App\Widget\Icon;

class BootstrapButton extends NormalElement
{
    public function __construct(
        string $btnType = 'submit',
        string $btnName = 'button',
        string $btnText = 'send',
        string $btnStyle = 'primary',
        string $btnSize = 'default',
        string $btnIconClass = null
    ) {
        $this->tagName = 'button';
        $this->addText($btnText);
        $this->setAttributes([
            'type' => $btnType,
            'name' => $btnName,
            'class' => "btn btn-$btnStyle btn-$btnSize",
            'value' => strtolower($btnText)
        ]);
        if (is_string($btnIconClass) && $btnIconClass !== '') {
            $this->addElement(new Icon($btnIconClass));
        }
    }
}
