<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSConnect;
use AprixApp\MoySklad\MSEntity;

class Product extends MSEntity
{
    const CODE_ENTITY = "product";

    public function setFilterByAttribute($idAttribute, $value)
    {
        $this->setFilter([
            "https://online.moysklad.ru/api/remap/1.2/entity/product/metadata/attributes/" . $idAttribute => $value
        ]);

        return $this;
    }
}