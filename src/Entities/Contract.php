<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithAttributes;
use AprixApp\MoySklad\Traits\EntityWithMetadata;

class Contract extends MSEntity
{
    use EntityWithMetadata, EntityWithAttributes;

    const CODE_ENTITY = 'contract';
}