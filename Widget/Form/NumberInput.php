<?php

namespace App\Widget\Form;

use App\Widget\Models\BaseInput;

class NumberInput extends BaseInput
{
    private const INPUT_TYPE = "number";
    public function __construct(string $name, string $id, $label = '', $labelIconClass = "")
    {
        $this->attributes['type'] = self::INPUT_TYPE;
        parent::__construct($name, $id, $label, $labelIconClass);
    }
}
