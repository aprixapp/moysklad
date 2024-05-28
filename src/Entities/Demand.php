<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithMetadata;
use AprixApp\MoySklad\Traits\EntityWithPositions;
use AprixApp\MoySklad\Traits\EntityWithPublicationAndTemplate;

class Demand extends MSEntity
{
    use EntityWithPositions, EntityWithMetadata, EntityWithPublicationAndTemplate;

    const CODE_ENTITY = "demand";
}