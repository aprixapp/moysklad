<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithAttributes;
use AprixApp\MoySklad\Traits\EntityWithMetadata;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class Order extends MSEntity
{
    use EntityWithPositions, EntityWithMetadata, EntityWithAttributes;

    const CODE_ENTITY = "customerorder";
}