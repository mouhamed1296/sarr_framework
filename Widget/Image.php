<?php

namespace App\widget;

use App\Widget\Models\VoidElement;

/**
 * 
 */
class Image extends VoidElement
{
	
	public function __construct(string $src,string $class = '', string $alt = 'image')
	{
		$this->tagName = 'img';
		$this->setAttributes([
			'src' => $src,
			'class' => $class,
			'alt' => $alt
		]);
	}
}
