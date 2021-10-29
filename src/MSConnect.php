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
        return json_decode($this->response->getBody()->getContents(), true);
    }

    public function getResponseRows()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['rows'];
    }

    public function getResponseMeta()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta'];
    }

    public function getResponseMetaLimit()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['limit'];
    }

    public function getResponseMetaSize()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['size'];
    }

    public function getResponseMetaOffset()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['offset'];
    }

    public function getResponseMetaHref(): string
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['href'];
    }

    public function getResponseMetaNextHref(): string
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['nextHref'];
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}