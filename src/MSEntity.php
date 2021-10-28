<?php

namespace AprixApp\MoySklad;

class MSEntity extends MSElement
{
    const ELEMENT_PART_HREF = '/entity';

    public function setFilterByAttribute($idAttribute, $value)
    {
        $this->setFilter([
            "https://online.moysklad.ru/api/remap/1.2/entity/" . static::CODE_ENTITY . "/metadata/attributes/" . $idAttribute => $value
        ]);

        return $this;
    }

    public function setOrganization($msID)
    {
        $this->arBodyPost["organization"] = MSTools::constructEntityMetaArray($msID, 'organization');

        return $this;
    }

    public function setAgent($msID)
    {
        $this->arBodyPost["agent"] = MSTools::constructEntityMetaArray($msID, 'counterparty');

        return $this;
    }

    public function setStore($msID)
    {
        $this->arBodyPost["store"] = MSTools::constructEntityMetaArray($msID, 'store');

        return $this;
    }

    public function setOwner($msID)
    {
        $this->arBodyPost["owner"] = MSTools::constructEntityMetaArray($msID, 'employee');

        return $this;
    }

    public function create()
    {
        $this->modified();

        return $this;
    }
}