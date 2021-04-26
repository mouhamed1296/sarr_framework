<?php

namespace App\Widget\Bootstrap;

use App\Core\Model;
use App\Widget\Div;
use App\Widget\Form\Label;
use App\Widget\TagBuilder;
use App\Widget\Models\NormalElement;
use App\Widget\Icon;

class BootstrapInput extends NormalElement
{
    public object $input;
    private const ACCEPTED_TYPE = [
        'text',
        'email',
        'password',
        'date',
        'week',
        'search',
        'button',
        'checkbox',
        'datetime-local',
        'file',
        'hidden',
        'image',
        'month',
        'number',
        'radio',
        'range',
        'tel',
        'time',
        'url',
        'textarea'
    ];

    /**
     * Constructor
     *
     * @param string $type
     * @param string $name
     * @param string $id
     * @param string $label
     * @param string|null $labelIconClass
     */
    public function __construct(
        string $type,
        string $name,
        string $id,
        string $label = '',
        ?string $labelIconClass = ''
    ) {
        $this->tagName = 'div';
        $this->addClass('form-group');
        $bsLabel = $this->addElement(new Label($label, $id, 'col-form-label'));
        if (is_string($labelIconClass) && $labelIconClass !== '') {
            $icon = new Icon($labelIconClass);
            $bsLabel->addText($icon->render(), 'first');
        }
        if (in_array($type, self::ACCEPTED_TYPE, true)) {
            if ($type === 'textarea') {
                $this->input = TagBuilder::createNormalElement('textarea');
                $this->input->setAttributes([
                    'name' => $name,
                    'id' => $id,
                    'placeholder' => $label,
                    'class' => 'form-control'
                ]);
                $this->addElement($this->input);
            } else {
                $this->input = TagBuilder::createVoidElement('input');
                $this->input->setAttributes([
                    'type' => $type,
                    'name' => $name,
                    'id' => $id,
                    'class' => 'form-control'
                ]);
                $this->addElement($this->input);
            }
        } else {
            $this->input = TagBuilder::createVoidElement('input');
            $this->input->setAttributes([
                'type' => 'text',
                'name' => $name,
                'id' => $id,
                'class' => 'form-control'
            ]);
            $this->addElement($this->input);
        }
    }

    /**
     * addValidations
     *
     * @param Model $model
     * @param array $attributes
     *
     * @return void
     */
    public static function addValidations(Model $model, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $attribute->addValidation($model, $attribute->input->getAttribute('name'));
        }
    }

    /**
     * addValidation
     *
     * @param Model $model
     * @param string $attribute
     *
     * @return void
     */
    public function addValidation(Model $model, string $attribute): void
    {
        if ($model->hasError($attribute)) {
            $this->input->setAttribute('value', $model->{$attribute});
            $this->input->removeClass('is-valid');
            $this->input->addClass('is-invalid');
            $this->addElement(new Div('invalid-feedback'))->addText($model->getFirstError($attribute));
        } else {
            $this->input->setAttribute('value', $model->{$attribute});
            $this->input->removeClass('is-invalid');
            $this->input->addClass('is-valid');
        }
    }
}
