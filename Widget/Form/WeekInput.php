<?php

namespace App\Widget\Form;

use App\Widget\Models\BaseInput;

class WeekInput extends BaseInput
{
    private const INPUT_TYPE = "week";
    public function __construct(string $name, string $id, $label = '', $labelIconClass = "")
    {
        $this->attributes['type'] = self::INPUT_TYPE;
        parent::__construct($name, $id, $label, $labelIconClass);
    }
}
