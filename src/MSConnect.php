<?php

namespace AprixApp\MoySklad;

use AprixApp\MoySklad\Entities\MSEntity;
use GuzzleHttp\Client;

class MSConnect
{
    const MS_HOST = 'https://online.moysklad.ru';
    const HREF_MAIN_PART = '/api/remap/1.2';

    protected $httpClient;
    protected $response;

    public function __construct(array $access)
    {
        if (isset($access['token'])) {
            $valueHeader = "Bearer " . $access['token'];
        } elseif (isset($access['login']) && isset($access['password'])) {
            $valueHeader = "Basic " . base64_encode($access['login'] . ':' . $access['password']);
        } else {
            new \Exception('Не указан токен или доступы для подключения');
        }

        $this->httpClient = new Client([
            'base_uri' => self::MS_HOST,
            'headers' => [
                "Authorization" => $valueHeader
            ]
        ]);
    }

    public function get($hrefPart)
    {
        $this->response = $this->httpClient->get(self::HREF_MAIN_PART . $hrefPart);

        return $this;
    }

    public function post($hrefPart, $arSendBody)
    {
        $this->httpClient->request(
            'POST',
            self::HREF_MAIN_PART . $hrefPart,
            [
                'json' => $arSendBody
            ]
        );

        return $this;
    }

    public function getJsonResponse()
    {
        $this->response->getBody()->rewind();

        return json_decode($this->response->getBody()->getContents(), true);
    }

    public function getResponseRows()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['rows']) ? $jsonResult['rows'] : [];
    }

    public function getResponseMeta()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']) ? $jsonResult['meta'] : [];
    }

    public function getResponseMetaLimit()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']['limit']) ? $jsonResult['meta']['limit'] : false;
    }

    public function getResponseMetaSize()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']['size']) ? $jsonResult['meta']['size'] : false;
    }

    public function getResponseMetaOffset()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']['offset']) ? $jsonResult['meta']['offset'] : false;
    }

    public function getResponseMetaHref(): string
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']['href']) ? $jsonResult['meta']['href'] : false;
    }

    public function getResponseMetaNextHref(): string
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['meta']['nextHref']) ? $jsonResult['meta']['nextHref'] : false;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}