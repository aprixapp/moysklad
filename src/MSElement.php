<?php

namespace AprixApp\MoySklad;

class MSElement
{
    protected $connect;
    protected $arQuery;
    protected $arBodyPost;
    protected $arItemsBody;
    protected $partHref;

    public function __construct(MSConnect $connect)
    {
        $this->connect = $connect;
    }

    public function setFilter($arFilter, $logic = false)
    {
        if (!empty($arFilter)) {
            $arFilterQuery = [];
            $lineLogic = $logic ? $logic : '=';
            foreach ($arFilter as $code => $values) {
                if (is_array($values)) {
                    $arFilterQuery = array_map(function ($value) use ($code, $lineLogic) {
                        return $code . $lineLogic . $value;
                    }, $values);
                } else {
                    $arFilterQuery[] = $code . $lineLogic . $values;
                }
            }
            $this->arQuery['filter'] = (!empty($this->arQuery['filter']) ? array_merge($this->arQuery['filter'], $arFilterQuery) : $arFilterQuery);
        }

        return $this;
    }

    public function setOrder($arOrders)
    {
        if (!empty($arOrders)) {
            $arOrdersQuery = [];
            foreach ($arOrders as $code => $order) {
                $arOrdersQuery[] = $order ? $code . ',' . $order : $code;
            }
            $this->arQuery['order'] = $arOrdersQuery;
        }

        return $this;
    }

    public function setLimit($limit)
    {
        if ($limit) {
            $this->arQuery['limit'] = $limit;
        }

        return $this;
    }

    public function setOffset($offset)
    {
        if ($offset) {
            $this->arQuery['offset'] = $offset;
        }

        return $this;
    }

    public function setFieldBody($name, $value)
    {
        $this->arBodyPost[$name] = $value;

        return $this;
    }

    public function setBody($arBody, $isReplace = false)
    {
        if ($isReplace) {
            $this->arBodyPost = $arBody;
        } else {
            $this->arBodyPost = array_merge($this->arBodyPost, $arBody);
        }

        return $this;
    }

    public function createItemBody()
    {
        $itemBody = new MSItemBody();
        $this->arItemsBody[] = $itemBody;

        return $itemBody;
    }

    public function constructQuery()
    {
        $arFinalQueryLine = [];
        if (!empty($this->arQuery)) {
            foreach ($this->arQuery as $keySection => $section) {
                if (is_array($section)) {
                    $arFinalQueryLine[] = $keySection . '=' . implode(';', $section);
                } else {
                    $arFinalQueryLine[] = $keySection . '=' . $section;
                }
            }

            return implode('&', $arFinalQueryLine);
        }

        return '';
    }

    public function constructMultiItemBody()
    {
        if (!empty($this->arItemsBody)) {
            $this->arBodyPost = [];
            /** @var MSItemBody $itemBody */
            foreach ($this->arItemsBody as $itemBody) {
                $this->arBodyPost[] = $itemBody->getBodyItem();
            }
        }

        return $this;
    }

    public function get()
    {
        $queryLine = $this->constructQuery();
        $requestUrl = $queryLine ? ($this->partHref . '?' . $queryLine) : $this->partHref;

        return $this->connect->get($requestUrl);
    }

    public function modified($method = 'POST')
    {
        if (!empty($this->arBodyPost)) {
            if ($method == 'PUT') {
                return $this->connect->put($this->partHref, $this->arBodyPost);
            } elseif ($method == 'POST') {
                return $this->connect->post($this->partHref, $this->arBodyPost);
            }

            throw new \Exception('Неизвестный метод');
        } else {
            throw new \Exception('Тело запроса пустое');
        }
    }

    public function getBodyPost()
    {
        return $this->arBodyPost;
    }

    public function getArQuery()
    {
        return $this->arQuery;
    }
}