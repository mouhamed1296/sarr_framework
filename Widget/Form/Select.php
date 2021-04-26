<?php

namespace App\Widget\Form;

use App\Widget\Models\NormalElement;
use App\Widget\Icon;

class Select extends NormalElement
{
    public array $options;

    public function __construct(
        string $name,
        string $id,
        $label = '',
        $labelClass = '',
        $labelIconClass = null
    ) {
        $this->tagName = "select";
        $this->attributes['name'] = $name;
        $this->attributes['id'] = $id;
        $selectLabel = $this->insertBefore(
            new Label($label, $id, $labelClass)
        );
        if ($labelIconClass !== '' && !is_null($labelIconClass)) {
            $selectLabel->addElement(new Icon($labelIconClass));
        }
    }
}
