<?php

namespace AprixApp\MoySklad\Traits;

use AprixApp\MoySklad\MSConnect;

trait EntityHasAsync
{
    public function getAsync(): MSConnect
    {
        $this->arQuery['async'] = 'true';
        $queryLine = $this->constructQuery();
        $requestUrl = $queryLine ? ($this->partHref . '?' . $queryLine) : $this->partHref;

        return $this->connect->get($requestUrl);
    }

    public function getAsyncStatus($href): string
    {
        $arResponse = $this
            ->connect
            ->get($href)
            ->getJsonResponse();

        return $arResponse['state'];
    }

    public function downloadAsyncResult($hrefResult, $pathSave): string
    {
        $statusDownload = $this
            ->connect
            ->download($hrefResult, $pathSave)
            ->getStatusCodeResponse();

        return $statusDownload == 200 ? $pathSave : '';
    }
}