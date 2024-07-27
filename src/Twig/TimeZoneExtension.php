<?php
// src/Twig/TimeZoneExtension.php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeZoneExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('convert_time', [$this, 'convertTime']),
        ];
    }

    public function convertTime(\DateTime $dateTime, $timeZone)
    {
        $dateTime->setTimezone(new \DateTimeZone($timeZone));
        return $dateTime;
    }
}
