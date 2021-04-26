<?php


namespace App\Widget\Bootstrap;


use App\Core\Model;
use App\Widget\Div;
use App\Widget\Form\Label;
use App\Widget\Form\Option;
use App\Widget\Icon;
use App\Widget\Models\NormalElement;
use App\Widget\TagBuilder;

class BootstrapSelect extends NormalElement
{
    public NormalElement $select;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $id
     * @param array $options
     * @param string $label
     * @param string|null $labelIconClass
     */
    public function __construct(
        string $name,
        string $id,
        array $options,
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
        $this->select = TagBuilder::createNormalElement('select');
        $this->select->setAttributes(['name' => $name, 'id' => $id]);
        $this->select->addClass('form-select');
        foreach ($options as $option) {
            $this->select->addElement(new Option($option))->addClass('form-control');
        }
        $this->addElement($this->select);
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
            $attribute->addValidation($model, $attribute->select->getAttribute('name'));
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
            $this->select->removeClass('is-valid');
            $this->select->addClass('is-invalid');
            $this->addElement(new Div('invalid-feedback my-0'))->addText($model->getFirstError($attribute));
        } else {
            $chosen = $this->select->getChild('value', $model->{$attribute});
            if (!is_null($chosen)) {
                $chosen->setAttribute('selected', true);
            }
            $this->select->removeClass('is-invalid');
            $this->select->addClass('is-valid');
        }
    }
}