<?php

namespace App\Core;

use DateTime;
use DateTimeZone;

class DateSn extends DateTime
{
    private string $datetime;
    private string $time;
    private string $date;

    public function __construct()
    {
        $date_time = new self("now", new DateTimeZone('Africa/Dakar'));
        $this->datetime = $date_time->format('Y-m-d H:i:s');
        $this->date = explode(" ", $this->datetime)[0];
        $this->time = explode(" ", $this->datetime)[1];
    }

    public function getDateTime(): string
    {
        return $this->datetime;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }
}
