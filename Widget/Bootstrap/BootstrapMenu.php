<?php

namespace App\Widget\Bootstrap;

use App\Widget\Models\NormalElement;
use App\Widget\Nav\ListItem;
use App\Widget\Nav\UnorderedList;
use App\Widget\Nav\Anchor;
use App\Widget\Div;
use App\Widget\TagBuilder;

class BootstrapMenu extends NormalElement
{
	public NormalElement $container;
	public NormalElement $brand;
	public NormalElement $toggler;
	public NormalElement $collapse;
	public NormalElement $ul;
	public array $links = [];

    public function __construct(array $links, ?string $brand = null, string $expandAt = 'lg', string $bgColor = 'light')
    {
        $this->tagName = 'nav';
        $this->addClass('navbar navbar-expand-' . $expandAt . ' navbar-' . $bgColor . ' bg-' . $bgColor);
        $this->container = $this->addElement(new Div('container'));
        $this->brand = $this->container->addElement(TagBuilder::createNormalElement('a'));
        (!is_null($brand)) ? $this->brand->addText($brand) : $this->brand->addText('Brand');
        $this->brand->setAttributes(['class' => 'navbar-brand', 'href' => '/']);
        $this->toggler = $this->container->addElement(TagBuilder::createNormalElement('button'));
        $this->toggler->setAttributes([
        	'class' => 'navbar-toggler',
        	'type' => 'button',
        	'data-mdb-toggle' => 'collapse',
        	'data-mdb-target' => '#navbarNav',
        	'aria-controls' => 'navbarNav',
        	'aria-expanded' => 'false',
        	'aria-label' => 'Toggle navigation'
        ]);
        $this->toggler->addElement(TagBuilder::createNormalElement('i'))->addClass('fas fa-bars');
        $this->collapse = $this->container->addElement(new Div('collapse navbar-collapse justify-content-end'));
        $this->collapse->setAttribute('id', 'navbarNav');
        $this->ul = new UnorderedList('navbar-nav mb-2 mb-lg-0');
        $this->collapse->addElement($this->ul);
        $linksArray = $this->addItems($links);
        $i = 0;
        foreach ($linksArray as $linkLabel => $linkHref) {
            $labelArray = explode(' I:', $linkLabel);

            /* Dropdown Menu Handling Start */

            if (is_array($linkHref)) {
                $dropdownContainer = new Div('dropdown');
                if (count($labelArray) > 1) {
                    $anchor = new Anchor($labelArray[0], '#', $labelArray[1]);
                } else {
                    $anchor = new Anchor($linkLabel, '#');
                }
                $anchor->setAttributes([
                    'class' => 'nav-link dropdown-toggle',
                    'role' => 'button',
                    'id' => 'ddMenu',
                    'data-mdb-toggle' => 'dropdown',
                    'aria-expanded' => false
                ]);
                $dropdownContainer->addElement($anchor);
                $subNav = $dropdownContainer->addElement(new UnorderedList('dropdown-menu'));
                $subNav->setAttributes([
                        'aria-labelledby' => 'ddMenu'
                    ]);
                foreach ($linkHref as $dropdownLabel => $dropdownHref) {
                    $subLabelArray = explode(' I:', $dropdownLabel);
                    if (count($subLabelArray) > 1) {
                        $subAnchor = new Anchor($subLabelArray[0], $dropdownHref, $subLabelArray[1]);
                    } else {
                        $subAnchor = new Anchor($dropdownLabel, $dropdownHref);
                    }
                    $subAnchor->addClass('dropdown-item');
                    $listItem = new ListItem();
                    $listItem->addElement($subAnchor);
                    $subNav->addElement($listItem);
                }
                $this->ul->addElement($dropdownContainer);

                /* Dropdown Menu Handling End */

            } else {
                if (count($labelArray) > 1) {
                    $anchor = new Anchor($labelArray[0], $linkHref, $labelArray[1]);
                } else {
                    $anchor = new Anchor($linkLabel, $linkHref);
                }
                ($i === 0)
                ? $anchor->setAttributes(['class' => 'nav-link active', 'aria-current' => 'page'])
                : $anchor->addClass('nav-link') ;
                $listItem = new listItem('nav-item');
                $listItem->addElement($anchor);
                $this->ul->addElement($listItem);
                $i++;
            }
        }
    }

    public function addItems(array $items)
    {
    	foreach ($items as $itemLabel => $itemHref) {
    		$this->links[$itemLabel] = $itemHref;
    	}
        return $this->links;
    }
}
