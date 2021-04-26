<?php

namespace App\Widget;

use App\Widget\Models\NormalElement;

/**
 * 
 */
class Span extends NormalElement
{
	
	public function __construct(string $classList = '', string $text = '')
	{
		$this->tagName = 'span';
		$this->addClass($classList);
		$this->addText($text);
	}
}
