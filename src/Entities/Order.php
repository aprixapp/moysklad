<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class Order extends MSEntity
{
    use EntityWithPositions;

    const CODE_ENTITY = "customerorder";
}