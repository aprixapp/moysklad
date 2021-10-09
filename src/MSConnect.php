<?php

namespace AprixApp\MoySklad;

use AprixApp\MoySklad\Entities\MSEntity;
use AprixApp\MoySklad\Interfaces\MSEntityable;
use GuzzleHttp\Client;

class MSConnect
{
    const MS_HOST = 'https://online.moysklad.ru';
    const MAIN_PART_ENDPOINT = '/api/remap/1.2/entity';
    const METADATA_PART = 'metadata';
    const METADATA_ATTRIBUTES = 'attributes';

    protected $httpClient;
    protected $response;
    /**
     * @var MSEntity
     */
    private $entity;

    public function __construct(array $access)
    {
        if ($access['TOKEN']) {
            $valueHeader = "Bearer " . $access['TOKEN'];
        } elseif (isset($access['LOGIN']) && isset($access['PASSWORD'])) {
            $valueHeader = "Basic " . base64_encode($access['LOGIN'] . ':' . $access['PASSWORD']);
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

    public function setEntity(MSEntityable $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function get()
    {
        $this->response = $this->httpClient->get(implode('/', [self::MAIN_PART_ENDPOINT, $this->entity->getEntityCode()]));

        return $this;
    }

    public function getByHref($hrefMS)
    {
        $this->response = $this->httpClient->get($hrefMS);

        return $this;
    }

    public function postJson($arSendBody)
    {
        $this->httpClient->request(
            'POST',
            implode('/', [self::MAIN_PART_ENDPOINT, $this->entity->getEntityCode()]),
            [
                'json' => $arSendBody
            ]
        );

        return $this;
    }


    public function getEntities($arFilter = [], $arOrders = [], $limit = false, $offset = false)
    {
        $arQuery = [];

        if (!empty($arFilter)) {
            $arFilterQuery = [];
            foreach ($arFilter as $code => $values) {
                if (is_array($values)) {
                    $arFilterQuery = array_map(function ($value) use ($code) {
                        return $code . "=" . $value;
                    }, $values);
                } else {
                    $arFilterQuery[] = $code . "=" . $values;
                }
            }

            $arQuery[] = 'filter=' . implode(';', $arFilterQuery);
        }

        if (!empty($arOrders)) {
            $arOrdersQuery = [];
            foreach ($arOrders as $code => $order) {
                $arOrdersQuery[] = $order ? $code . ',' . $order : $code;
            }
            $arQuery[] = 'order=' . implode(';', $arOrdersQuery);
        }

        if ($limit) {
            $arQuery[] = 'limit=' . $limit;
        }

        if ($offset) {
            $arQuery[] = 'offset=' . $offset;
        }

        $lineUrl = implode('/', [self::MAIN_PART_ENDPOINT, $this->entity->getEntityCode()]);

        $requestUrl = (!empty($arQuery) ? $lineUrl . '?' . implode('&', $arQuery) : $lineUrl);

        $this->response = $this->httpClient->get($requestUrl);

        return $this;
    }

    public function getMetadataAttributes()
    {
        $arPathParts = [
            self::MAIN_PART_ENDPOINT,
            $this->entity->getEntityCode(),
            self::METADATA_PART,
            self::METADATA_ATTRIBUTES
        ];

        return $this->getByHref(implode('/', $arPathParts));
    }

    public function getMetadata()
    {
        $arPathParts = [
            self::MAIN_PART_ENDPOINT,
            $this->entity->getEntityCode(),
            self::METADATA_PART
        ];

        return $this->getByHref(implode('/', $arPathParts));
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

    public function getResponseMetaHref()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['href'];
    }

    public function getResponseMetaNextHref()
    {
        $jsonResult = json_decode($this->response->getBody()->getContents(), true);

        return $jsonResult['meta']['nextHref'];
    }
}