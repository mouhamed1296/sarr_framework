<?php

/**
 * My MVC Framework
 *
 * @category Description
 * @package  Category
 * @author   Mamadou Sarr <mbayelel@gmail.com>
 * @license  MIT http://github.com
 * @version  "GIT: 1.0.0"
 * @link     http://github.com
 */

namespace App\Widget;

use App\Widget\Models\NormalElement;

/**
 * [Description Icon]
 *
 * @category Description
 * @package  Category
 * @author   Mamadou Sarr <mbayelel@gmail.com>
 * @license  MIT http://github.com
 * @version  "Release: 1.0.0"
 * @link     http://github.com
 */
class Icon extends NormalElement
{
    /**
     * Icon constructor.
     *
     * @param string $classList la liste des classes qui définissent l'icône
     */
    public function __construct(string $classList)
    {
        $this->tagName = "i";
        $this->attributes['class'] = $classList;
        $this->attributes['style'] = "margin-right: 0.2rem";
    }
}
