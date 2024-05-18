<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class Supply extends MSEntity
{
    use EntityWithPositions;

    const CODE_ENTITY = "supply";
}