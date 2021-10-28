<?php

namespace AprixApp\MoySklad;

class MSItemBody
{
    private $arBodyItem;

    public function __construct()
    {
        $this->arBodyItem = [];
    }

    public function setOrganization($msID)
    {
        $this->arBodyItem["organization"] = MSTools::constructEntityMetaArray($msID, 'organization');

        return $this;
    }

    public function setAgent($msID)
    {
        $this->arBodyItem["agent"] = MSTools::constructEntityMetaArray($msID, 'counterparty');

        return $this;
    }

    public function setStore($msID)
    {
        $this->arBodyItem["store"] = MSTools::constructEntityMetaArray($msID, 'store');

        return $this;
    }

    public function setOwner($msID)
    {
        $this->arBodyItem["owner"] = MSTools::constructEntityMetaArray($msID, 'employee');

        return $this;
    }

    public function setBodyField($name, $value)
    {
        $this->arBodyItem[$name] = $value;

        return $this;
    }

    public function getBodyItem()
    {
        return $this->arBodyItem;
    }
}