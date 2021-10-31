<?php

namespace AprixApp\MoySklad;

class MSDate
{
    const DATE_FORMAT_MS = 'Y-m-d H:i:s.v';

    private $dateTimeMS;

    public function __construct($dateLine)
    {
        $this->dateTimeMS = \DateTime::createFromFormat(self::DATE_FORMAT_MS, $dateLine);
    }

    public function getFormat($format)
    {
        return $this->dateTimeMS->format($format);
    }
}