<?php

namespace App\Widget\Bootstrap;

use App\Widget\{
	Heading,
	Image,
	TagBuilder,
	Div
};

use App\Widget\Models\NormalElement;

/**
 * 
 */
class BootstrapCard extends NormalElement
{
	public ?NormalElement $header;
	public Image $image;
	public NormalElement $body;
	public NormalElement $title;
	public ?NormalElement $subTitle;
	public NormalElement $text;
	public ?NormalElement $footer;
	
	public function __construct(?string $header, array $image, string $title, string $text = 'card Text Here', ?string $footer)
	{
		$this->tagName = 'div';
		$this->setAttributes([
			'class' => 'card'
		]);
		$headerEls = explode(': ', $header);
		$headerTagNumber = (int) $headerEls[0];
		$this->header = (!is_null($header)) ? $this->addElement(new Heading($headerEls[1], $headerTagNumber, 'card-header')) : null;
		foreach ($image as $src => $position) {
			$this->image = new Image($src, 'card-img-' . $position);
		}
		$this->addElement($this->image);
		$this->body = $this->addElement(new Div('card-body'));
		$titles = explode(' st:', $title);
		$this->title = $this->body->addElement(new Heading($titles[0], 5, 'card-title'));
		if (isset($titles[1])) {
			$this->subTitle = $this->body->addElement(new Heading($titles[1], 6, 'card-subtitle'));
		}
		$this->text = $this->body->addElement(TagBuilder::createNormalElement('p'));
		$this->text->addText($text);

		$this->footer = (!is_null($footer)) ? $this->addElement(new Div('card-footer'))->addText($footer) : null;
	}
}
