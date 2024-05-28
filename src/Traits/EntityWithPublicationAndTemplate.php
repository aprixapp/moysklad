<?php

namespace AprixApp\MoySklad\Traits;

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
}