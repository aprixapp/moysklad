<?php

namespace AprixApp\MoySklad;

class MSTools
{
    const ID_MS_TEMPLATE = '/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/';

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

    public static function extractIDFromHref($href)
    {
        $arHref = explode('/', $href);

        return $arHref[count($arHref) - 1];
    }

    public static function constructAttributeMetaArray($id, $entity)
    {
        return [
            'meta' => [
                "href" => "https://online.moysklad.ru/api/remap/1.2/entity/" . $entity . '/metadata/attributes/' . $id,
                "type" => 'attributemetadata',
                "mediaType" => "application/json"
            ]
        ];
    }

    public static function isMSId($id)
    {
        return preg_match(self::ID_MS_TEMPLATE, $id);
    }
}