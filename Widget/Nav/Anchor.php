<?php

/**
 * My MVC Framework
 *
 * @category Description
 * @package  Category
 * @author   Mamadou Sarr <mbayelel@gmail.com>
 * @license  MIT http://github.com
 * @version  'GIT: 1.0.0'
 * @link     http://github.com
 */

namespace App\Widget\Nav;

use App\Widget\Models\NormalElement;
use App\Widget\Icon;

/**
 * [Description Anchor]
 *
 * @category Description
 * @package  Category
 * @author   Mamadou Sarr <mbayelel@gmail.com>
 * @license  MIT http://github.com
 * @version  'Release: 1.0.0'
 * @link     http://github.com
 */
class Anchor extends NormalElement
{
    /**
     * Anchor constructor.
     *
     * @param string $linkName l
     * @param string $href     l
     * @param string $iconClassList
     */
    public function __construct(string $linkName, string $href = '', ?string $iconClassList = null)
    {
        $this->tagName = 'a';
        $this->addText($linkName);
        $this->attributes['href'] = $href;
        if (is_string($iconClassList) && $iconClassList != '') {
            $this->addElement(new Icon($iconClassList));
        }
    }
}
