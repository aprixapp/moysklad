<?php

namespace AprixApp\MoySklad\Traits;

use AprixApp\MoySklad\MSConnect;

trait EntityWithPositions
{
    public function getPositions($idEntity): MSConnect
    {
        $partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/' . $idEntity .'/positions';

        return $this->connect->get($partHref);
    }
}