<?php

namespace AprixApp\MoySklad;

class MSEntity extends MSElement
{
    const ELEMENT_PART_HREF = '/entity';

    public function setOrganization($msID)
    {
        $this->arBodyPost["organization"] = [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/organization/" . $msID,
                "type" => "organization",
                "mediaType" => "application/json"
            ]
        ];

        return $this;
    }

    public function setAgent($msID)
    {
        $this->arBodyPost["agent"] = [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/counterparty/" . $msID,
                "type" => "counterparty",
                "mediaType" => "application/json"
            ]
        ];

        return $this;
    }

    public function setStore($msID)
    {
        $this->arBodyPost["store"] = [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/store/" . $msID,
                "type" => "store",
                "mediaType" => "application/json"
            ]
        ];

        return $this;
    }

    public function setOwner($msID)
    {
        $this->arBodyPost["owner"] = [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/employee/" . $msID,
                "metadataHref" => "https://online.moysklad.ru/api/remap/1.2/entity/employee/metadata",
                "type" => "store",
                "mediaType" => "application/json"
            ]
        ];

        return $this;
    }

    public function create()
    {
        $this->modified();

        return $this;
    }
}