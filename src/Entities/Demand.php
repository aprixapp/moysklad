<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class Demand extends MSEntity
{
    use EntityWithPositions;

    const CODE_ENTITY = "demand";
}