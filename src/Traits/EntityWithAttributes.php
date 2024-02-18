<?php

namespace AprixApp\MoySklad\Traits;

use AprixApp\MoySklad\MSConnect;

trait EntityWithAttributes
{
    public function getAttributes(): MSConnect
    {
        $partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/metadata/attributes';

        return $this->connect->get($partHref);
    }
}