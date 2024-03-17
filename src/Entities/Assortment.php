<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSEntity;
use AprixApp\MoySklad\Traits\EntityHasAsync;

class Assortment extends MSEntity
{
    use EntityHasAsync;

    const CODE_ENTITY = "assortment";
}