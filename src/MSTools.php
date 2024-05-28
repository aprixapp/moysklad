<?php

namespace AprixApp\MoySklad;

class MSTools extends AbstractMSService
{
    public static function constructEntityMetaArray($id, $entity): array
    {
        return [
            'meta' => [
                "href" => self::MS_HOST . "/api/remap/1.2/entity/" . $entity . '/' . $id,
                "type" => $entity,
                "mediaType" => "application/json"
            ]
        ];
    }

    public static function constructEntityStateMetaArray($uuid, $entity): array
    {
        return [
            'meta' => [
                "href" => self::MS_HOST . "/api/remap/1.2/entity/" . $entity . '/metadata/states/' . $uuid,
                "type" => "state",
                "mediaType" => "application/json"
            ]
        ];
    }

    public static function extractIDFromHref($href)
    {
        $arHref = explode('/', $href);

        return $arHref[count($arHref) - 1];
    }

    public static function constructAttributeMetaArray($id, $entity): array
    {
        return [
            'meta' => [
                "href" => self::MS_HOST . "/api/remap/1.2/entity/" . $entity . '/metadata/attributes/' . $id,
                "type" => 'attributemetadata',
                "mediaType" => "application/json"
            ]
        ];
    }

    public static function constructCustomTemplateMetaArray($id, $entity): array
    {
        return [
            'meta' => [
                "href" => self::MS_HOST . "/api/remap/1.2/entity/" . $entity . '/metadata/customtemplate/' . $id,
                "type" => 'customtemplate',
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

    public static function getMSHost(): string
    {
        return self::MS_HOST;
    }

    public static function getPartHrefWithoutBaseEndpoint($fullPath)
    {
        $pattern = '/^' . addcslashes(MSConnect::MS_HOST . MSConnect::HREF_MAIN_PART, '/') . '/';

        return preg_replace($pattern, '', $fullPath);
    }
}