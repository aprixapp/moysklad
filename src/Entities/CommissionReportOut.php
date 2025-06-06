<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityWithAttributes;
use AprixApp\MoySklad\Traits\EntityWithMetadata;
use AprixApp\MoySklad\Traits\EntityWithPositions;

class CommissionReportOut extends MSEntity
{
    use EntityWithAttributes, EntityWithMetadata, EntityWithPositions;

    const CODE_ENTITY = "commissionreportout";
}