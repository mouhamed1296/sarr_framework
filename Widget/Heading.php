<?php

namespace App\widget;

use App\Widget\Models\NormalElement;

/**
 * 
 */
class Heading extends NormalElement
{
	
	public function __construct(string $headerText, int $type = 1, string $class = '')
	{
		$this->tagName = ($type <= 6) ? 'h' . $type : 'h1';
		$this->addClass($class);
		$this->addText($headerText);
	}
}
