<?php

namespace AprixApp\MoySklad\Traits;

use AprixApp\MoySklad\MSConnect;

trait EntityWithMetadata
{
    public function getMetadata(): MSConnect
    {
        $partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/metadata';

        return $this->connect->get($partHref);
    }
}