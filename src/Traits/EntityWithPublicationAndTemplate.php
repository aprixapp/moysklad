<?php

namespace AprixApp\MoySklad\Traits;

use AprixApp\MoySklad\MSConnect;
use AprixApp\MoySklad\MSTools;

trait EntityWithPublicationAndTemplate
{
    public function createPublicationByTemplateUUID($customTemplateUUID)
    {
        $currentPartHref = $this->getPartHref();
        $this->setFullPath($currentPartHref . '/publication');
        $arMetaCustomTemplate = MSTools::constructCustomTemplateMetaArray($customTemplateUUID, static::CODE_ENTITY);

        $arBodyResponse = [
            "template" => $arMetaCustomTemplate
        ];

        return $this
            ->setBody($arBodyResponse, true)
            ->modified()
            ->getJsonResponse();
    }

    public function getListEmbeddedTemplates(): MSConnect
    {
        $partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/metadata/embeddedtemplate';

        return $this->connect->get($partHref);
    }

    public function getListCustomTemplates(): MSConnect
    {
        $partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/metadata/customtemplate';

        return $this->connect->get($partHref);
    }
}