<?php

namespace AprixApp\MoySklad;

class MSTools
{
    public static function constructEntityMetaArray($id, $entity)
    {
        return [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/" . $entity . '/' . $id,
                "type" => $entity,
                "mediaType" => "application/json"
            ]
        ];
    }
}