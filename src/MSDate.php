<?php

namespace AprixApp\MoySklad;

class MSDate
{
    const DATE_FORMAT_MS = 'Y-m-d H:i:s.v';

    private $dateTimeMS;

    public function __construct($dateLine = false)
    {
        if ($dateLine) {
            $this->dateTimeMS = \DateTime::createFromFormat(self::DATE_FORMAT_MS, $dateLine);
        } else {
            $this->dateTimeMS = new \DateTime();
        }

    }

    public function getFormat($format = false)
    {
        return $this->dateTimeMS->format($format ? $format : self::DATE_FORMAT_MS);
    }
}