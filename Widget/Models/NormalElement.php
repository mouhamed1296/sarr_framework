<?php

namespace App\Widget\Models;

/**
 * [Description NormalElement]
 */
abstract class NormalElement extends HtmlElement implements SupportChildElement
{
    /**
     * $elements
     *
     * @var array
     */
    public array $elements = [];

    public object $parent;

    /**
     * $firstChildText
     *
     * @var string|null
     */
    public ?string $firstChildText = null;
    /**
     * $lastChildText
     *
     * @var string|null
     */
    public ?string $lastChildText = null;

    /**
     * @inheritDoc
     */
    public function hasParent(): bool
    {
        return !empty($this->parents);
    }

    /**
     * @inheritDoc
     */
    public function getParent(): ?object
    {
        return $this->parent ?? null;
    }

    /**
     * @param object $child
     * @param object $parent
     * @return void
     */
    private function setParent(object $child, object $parent): void
    {
        $child->parent = $parent;
    }

    /**
     * @inheritDoc
     *
     */
    public function addElement($el): object
    {
        $this->elements[] = $el;
        $this->setParent($el, $this);
        return $el;
    }

    /**
     * @inheritDoc
     */
    public function addElements(array $els): array
    {
        foreach ($els as $el) {
            $this->elements[] = $el;
            $this->setParent($el, $this);
        }
        return $this->elements;
    }
    /**
     * @inheritDoc
     */
    public function getChild(string $attribute, string $value): ?object
    {
        $i = 0;
        $numChild = count($this->elements);
        $child = null;
        while ($i < $numChild) {
            if ($this->elements[$i]->getAttribute($attribute) === $value) {
                $child = $this->elements[$i];
                break;
            }
            $i++;
        }
        return $child;
    }
    /**
     * @inheritDoc
     */
    public function getFirstChild(): ?object
    {
        return $this->elements[0] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getLastChild(): ?object
    {
        return $this->elements[count($this->elements) - 1] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getChilds(): ?array
    {
        return (isset($this->elements) && !empty($this->elements)) ? $this->elements : null;
    }

    public function removeChild(string $attribute, string $value): bool
    {
        $removed = false;
        $i = 0;
        $n = count($this->elements);
        while ($i < $n) {
            if (($this->elements[$i]->getAttribute($attribute) === $value)) {
                unset($this->elements[$i]);
                $removed = true;
                break;
            }
            $i++;
        }
        return $removed;
    }


    public function insertAfterBegin($el): object
    {
        array_unshift($this->elements, $el);
        $this->setParent($el, $this);
        return $el;
    }

    public function insertBeforeEnd($el): object
    {
        $this->elements[] = $el;
        $this->setParent($el, $this);
        return $el;
    }

    /**
     * @inheritDoc
     */
    public function addText(string $text, string $position = "last"): object
    {
        if ($position === "last") {
            $this->lastChildText = $text;
        } elseif ($position === "first") {
            $this->firstChildText = $text;
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeText(string $position): void
    {
        ($position === 'first') ? $this->firstChildText = null : $this->lastChildText = null;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $beforeElements = implode(PHP_EOL, array_map(static fn($el) => $el->render(), $this->beforeElement));
        $content = implode(PHP_EOL, array_map(static fn($el) => $el->render(), $this->elements));
        $afterElements = implode(PHP_EOL, array_map(static fn($el) => $el->render(), $this->afterElement));
        return sprintf(
            '%s<%s %s>%s</%s>%s',
            $beforeElements,
            $this->tagName,
            $this->setAttributes($this->attributes),
            $this->firstChildText . $content . $this->lastChildText,
            $this->tagName,
            $afterElements
        );
    }
}
