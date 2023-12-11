<?php

namespace AprixApp\MoySklad;

use AprixApp\MoySklad\Entities\MSEntity;
use GuzzleHttp\Client;

class MSConnect extends AbstractMSService
{
    protected $httpClient;
    protected $response;
    protected $requestParams;
    protected $isSetStream;

    public function __construct(array $access, $requestOptions = [])
    {
        if (isset($access['token'])) {
            $valueHeader = "Bearer " . $access['token'];
        } elseif (isset($access['login']) && isset($access['password'])) {
            $valueHeader = "Basic " . base64_encode($access['login'] . ':' . $access['password']);
        } else {
            new \Exception('Не указан токен или доступы для подключения');
        }

        $this->requestParams = [
            'base_uri' => self::MS_HOST,
            'headers' => [
                "Authorization" => $valueHeader,
                'Accept-Encoding' => 'gzip'
            ]
        ];

        if (!empty($requestOptions)) {
            $this->requestParams = array_merge($this->requestParams, $requestOptions);
        }

        if (!empty($requestOptions) && isset($requestOptions['stream'])) {
            $this->isSetStream = $requestOptions['stream'];
        }

        $this->httpClient = new Client($this->requestParams);
    }

    public function get($hrefPart)
    {
        $this->response = $this->httpClient->get(
            self::HREF_MAIN_PART . $hrefPart, [
            'decode_content' => 'gzip'
        ]);

        return $this;
    }

    public function post($hrefPart, $arSendBody)
    {
        $this->response = $this->httpClient->request(
            'POST',
            self::HREF_MAIN_PART . $hrefPart,
            [
                'json' => $arSendBody,
                'decode_content' => 'gzip'
            ]
        );

        return $this;
    }

    public function put($hrefPart, $arSendBody)
    {
        $this->response = $this->httpClient->request(
            'PUT',
            self::HREF_MAIN_PART . $hrefPart,
            [
                'json' => $arSendBody,
                'decode_content' => 'gzip'
            ]
        );

        return $this;
    }

    public function getJsonResponse()
    {
        if (!$this->isSetStream) {
            $this->response->getBody()->rewind();
        }

        return json_decode($this->response->getBody()->getContents(), true);
    }

    public function getResponseRows()
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult['rows']) ? $jsonResult['rows'] : [];
    }

    public function getResponseField($keyField)
    {
        $jsonResult = $this->getJsonResponse();

        return isset($jsonResult[$keyField]) ? $jsonResult[$keyField] : [];
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

    public function getRequestParams(): array
    {
        return $this->requestParams;
    }
}