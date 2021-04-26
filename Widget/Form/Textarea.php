<?php

namespace App\Widget\Form;

use App\Widget\Icon;
use App\Widget\Models\NormalElement;

class Textarea extends NormalElement
{
    public function __construct(
        string $class,
        string $id,
        string $placeholder = "",
        $label = '',
        $labelClass = '',
        $labelIconClass = null
    ) {
        $this->tagName = "textarea";
        $this->attributes["class"] = $class;
        $this->attributes["id"] = $id;
        $this->attributes["placeholder"] = $placeholder;
        $selectLabel = $this->insertBefore(
            new Label($label, $id, $labelClass)
        );
        if ($labelIconClass !== '' && !is_null($labelIconClass)) {
            $selectLabel->addElement(new Icon($labelIconClass));
        }
    }
}
