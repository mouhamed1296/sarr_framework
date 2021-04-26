<?php

namespace App\Widget\Models;

interface SupportChildElement
{
    /**
     * @param VoidElement|NormalElement $el
     * @return VoidElement|NormalElement
     */
    public function addElement($el): object;

    /**
     * @param array $els
     * @return VoidElement[]|NormalElement[]
     */
    public function addElements(array $els): array;

    /**
     * @return bool
     */
    public function hasParent(): bool;

    /**
     * @return object|null
     */
    public function getParent(): ?object;

    /**
     * removeChild
     *
     * @param string $attribute
     * @param string $value
     * @return bool
     */
    public function removeChild(string $attribute, string $value): bool;

    /**
     * @param string $attribute
     * @param string $value
     * @return object
     */
    public function getChild(string $attribute, string $value): ?object;

    /**
     * @return object|null
     */
    public function getFirstChild(): ?object;

    /**
     * @return object|null
     */
    public function getLastChild(): ?object;

    /**
     * @return array|null
     */
    public function getChilds(): ?array;

    /**
     * @param string $text
     * @param string $position
     * @return VoidElement|NormalElement
     */
    public function addText(string $text, string $position): object;

    /**
     * removeText
     *
     * @param string $position la position du text à supprimer (last ou first)
     *
     * @return void
     */
    public function removeText(string $position): void;

    /**
     * insertAfterBegin
     *
     * @param VoidElement|NormalElement $el
     *
     * @return VoidElement|NormalElement
     */
    public function insertAfterBegin($el): object;

    /**
     * insertBeforeEnd
     *
     * @param VoidElement|NormalElement $el
     *
     * @return VoidElement|NormalElement
     */
    public function insertBeforeEnd($el): object;
}
