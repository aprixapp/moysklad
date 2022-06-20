<?php

namespace AprixApp\MoySklad;

class MSTools extends AbstractMSService
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

    public static function getWorkPartUri($fullUri)
    {
        return str_replace([self::MS_HOST, self::HREF_MAIN_PART], "", $fullUri);
    }
}