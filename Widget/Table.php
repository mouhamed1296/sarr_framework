<?php
namespace App\Widget;

use App\Widget\Models\NormalElement;

class Table extends NormalElement
{
    public static $rows = [];
    public function __construct(string $class = "", int $numRows = 0)
    {
        $this->tagName = 'table';
        $i = 0;
        while ($i < $numRows) {
            self::$rows[] = $this->addElement("tr");
            $i++;
        }
    }
}
