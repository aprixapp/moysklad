<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithMetadata;

class PurchaseOrder extends MSEntity
{
    use EntityWithMetadata;

    const CODE_ENTITY = "purchaseorder";
}