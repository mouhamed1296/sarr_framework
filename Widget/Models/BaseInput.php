<?php

namespace App\Widget\Models;

use App\Widget\Icon;
use App\Widget\Form\Label;

/**
 * [Description BaseInput]
 */
abstract class BaseInput extends VoidElement
{
    /**
     * $labelText
     *
     * @var string
     */
    public string $labelText;
    /**
     * $label
     *
     * @var Label
     */
    public Label $label;
    /**
     * $icon
     *
     * @var NormalElement
     */
    private NormalElement $icon;
    /**
     * $labelIconClass
     *
     * @var string|null
     */
    public ?string $labelIconClass = null;
    private const TAG_NAME = "input";

    /**
     * __construct
     *
     * @param string $name le nom du champ
     * @param string $id l'id du champ
     * @param string $labelText le label associé au champ
     * @param string|null $labelIconClass
     *
     * @return void
     */
    public function __construct(string $name, string $id, string $labelText = '', ?string $labelIconClass = null)
    {
        $this->labelText = $labelText;
        $this->attributes['name'] = $name;
        $this->attributes['id'] = $id;
        if (is_string($labelIconClass) && $labelIconClass !== "") {
            $this->labelIconClass = $labelIconClass;
            $this->icon = new Icon($labelIconClass);
        }
        $this->tagName = self::TAG_NAME;
    }

    /**
     * associateLabel
     *
     * @return string
     */
    private function associateLabel(): string
    {
        $this->label = new Label($this->labelText, $this->getAttribute("id"));
        if (is_string($this->labelIconClass)) {
            $this->label->addElement($this->icon);
        }
        return $this->label->render();
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->associateLabel() . parent::render();
    }
}
