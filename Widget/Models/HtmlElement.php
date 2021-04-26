<?php

namespace App\Widget\Models;

/**
 * Class HtmlElement
 * @package App\Widget\Models
 */
abstract class HtmlElement
{

    /**
     * $attributes
     *
     * @var array Ce tableau contient tous les attributs d'un élément
     */
    protected array $attributes = [];

    /**
     * $afterElement
     *
     * @var array Ce tableau contient tous les éléments insérés aprés un élément
     */
    public array $afterElement = [];
    /**
     * $beforeElement
     *
     * @var array Ce tableau contient tous les éléments insérés avant un élément
     */
    public array $beforeElement = [];
    /**
     * $tagName
     *
     * @var string le nom de la balise HTML à créer
     */
    public string $tagName = "";

    /**
     * @param array $attributes le tableau contenant les attributs à ajouter
     * à un élément associé à leur valeurs
     * ex: ["class" => "myClassName", "id" => "myId", ...]
     *
     * @return string la liste des attributs ajouté à un élément
     */
    public function setAttributes(array $attributes): string
    {
        $attributeList = '';
        foreach ($attributes as $attribute => $value) {
            $attributeList .= $this->setAttribute($attribute, $value);
        }
        return trim($attributeList);
    }

    /**
     * @param string $attribute
     * @param string|null $value
     * @return string
     */
    public function setAttribute(string $attribute, ?string $value): string
    {
        $attributeList = '';
        $this->attributes[$attribute] = $value;
        $attributeList .= (!is_null($value)) ? $attribute . '="' . $value . '" ' : $attribute . " ";
        return $attributeList;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $attributeName
     * @return string|null
     */
    public function getAttribute(string $attributeName): ?string
    {
        return $this->attributes[$attributeName] ?? null;
    }

    /**
     * addClass
     *
     * @param string $className
     *
     * @return HtmlElement
     */
    public function addClass(string $className): HtmlElement
    {
        $this->attributes['class'] = (isset($this->attributes['class']) && !empty($this->attributes['class']))
        ? $this->attributes['class'] . ' ' . $className
        : $className;
        return $this;
        /*$this->attributes['class'] = "$className " . $this->attributes['class'] ?? $className;*/
    }

    /**
     * removeAttribute
     *
     * @param string $attributeName
     *
     * @return void
     */
    public function removeAttribute(string $attributeName): void
    {
        unset($this->attributes[$attributeName]);
    }

    /**
     * removeAttributes
     *
     * @param array $attributes
     *
     * @return void
     */
    public function removeAttributes(array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $this->removeAttribute($attribute);
        }
    }

    /**
     * removeClass
     *
     * @param string $className
     *
     * @return void
     */
    public function removeClass(string $className): void
    {
        if (isset($this->attributes['class'])) {
            $this->attributes['class'] = strtr(
                trim(strtr($this->attributes['class'], [$className => null])),
                ["  " => " "]
            );
        }
    }

    /**
     * @param array $classes
     */
    public function removeClasses(array $classes): void
    {
        foreach ($classes as $class) {
            $this->removeClass($class);
        }
    }

    /**
     * insertAfter
     *
     * @param VoidElement|NormalElement $el
     *
     * @return VoidElement|NormalElement
     */
    public function insertAfter($el): object
    {
        $this->afterElement[] = $el;
        return $el;
    }
    /**
     * insertBefore
     *
     * @param VoidElement|NormalElement $el
     *
     * @return VoidElement|NormalElement
     */
    public function insertBefore($el): object
    {
        $this->beforeElement[] = $el;
        return $el;
    }

    /**
     * @return string
     */
    abstract public function render(): string;
}
