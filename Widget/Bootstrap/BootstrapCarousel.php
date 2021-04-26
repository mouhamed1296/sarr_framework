<?php

namespace App\Widget\Bootstrap;

use App\Widget\Models\NormalElement;
use App\Widget\Nav\{
	OrderedList,
	ListItem,
	Anchor
};
use App\Widget\{
	Div,
	Image,
	Span
};

/**
 * 
 */
class BootstrapCarousel extends NormalElement
{
	public object $indicators;
	public object $slideWrapper;
	public array $images;

	public function __construct(array $images, string $id = 'carouselExample')
	{
		$this->tagName = 'div';
		$this->setAttributes([
			'id' => $id,
			'class' => 'carousel slide carousel-fade',
			'data-ride' => 'carousel'
		]);
		$this->indicators = $this->addElement(new OrderedList('carousel-indicators'));
		$this->slideWrapper = $this->addElement(new Div('carousel-inner'));
		$this->slideWrapper->setAttribute('role', 'listbox');
		$i = 0;
		$numIndicators = count($images);
		while ($i < $numIndicators) {
			$listItem = $this->indicators->addElement(new ListItem());
			$listItem->removeAttribute('class');
			$item = $this->slideWrapper->addElement(new Div('carousel-item'));
			if ($i === 0) {
				$listItem->addClass('active');
				$item->addClass('active');
			}
			$imageAttr = explode(' class:', $images[$i]);
			$this->images[$i] = new Image($imageAttr[0], $imageAttr[1]);
			$item->addElement($this->images[$i]);
			$caption = explode(' caption:', $imageAttr[1]);
			if (isset($caption[1]) && !is_null($caption[1])) {
				$item->addElement(new Div('carousel-caption d-none d-md-block'))->addText($caption[1]);
			}
			$listItem->setAttributes([
				'data-target' => '#' . $id,
				'data-slide-to' => $i
			]);
			$i++;
		}
		$prev = $this->addElement(new Anchor('', '#' . $id));
		$prev->setAttributes([
			'class' => 'carousel-control-prev',
			'role' => 'button',
			'data-slide' => 'prev'
		]);
		$prev->addElement(new Span('carousel-control-prev-icon'))->setAttribute('aria-hidden', 'true');
		$prev->addElement(new Span('sr-only'))->addText('previous');
		$next = $this->addElement(new Anchor('', '#' . $id));
		$next->setAttributes([
			'class' => 'carousel-control-next',
			'role' => 'button',
			'data-slide' => 'next'
		]);
		$next->addElement(new Span('carousel-control-next-icon'))->setAttribute('aria-hidden', 'true');
		$next->addElement(new Span('sr-only'))->addText('next');
	}
}
