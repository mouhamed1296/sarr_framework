<?php

namespace App\Widget\Models;

abstract class VoidElement extends HtmlElement
{
    /**
     * @inheritDoc
     */

    public function render(): string
    {
        $beforeElements = implode(PHP_EOL, array_map(static fn($el) => $el->render(), $this->beforeElement));
        $afterElements = implode(PHP_EOL, array_map(static fn($el) => $el->render(), $this->afterElement));
        return sprintf(
            '%s<%s %s />%s',
            $beforeElements,
            $this->tagName,
            $this->setAttributes($this->attributes),
            $afterElements
        );
    }
}
