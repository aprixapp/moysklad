<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithMetadata;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class Move extends MSEntity
{
    use EntityWithPositions, EntityWithMetadata;

    const CODE_ENTITY = "move";
}