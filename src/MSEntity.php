<?php

namespace AprixApp\MoySklad;

abstract class MSEntity extends MSElement
{
    const ELEMENT_PART_HREF = '/entity';

    public function __construct(MSConnect $connect)
    {
        parent::__construct($connect);

        $this->partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY;
    }

    public function setPersonalHref($idEntityMS)
    {
        $this->partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY . '/' . $idEntityMS;

        return $this;
    }

    public static function createHrefEntityByID($idMS)
    {
        return MSConnect::MS_HOST . MSConnect::HREF_MAIN_PART . '/entity/' . static::CODE_ENTITY . '/' . $idMS;
    }

    public function setFilterByAttribute($idAttribute, $value, $logic = false)
    {
        $this->setFilter([
            "https://online.moysklad.ru/api/remap/1.2/entity/" . static::CODE_ENTITY . "/metadata/attributes/" . $idAttribute => $value
        ], $logic);

        return $this;
    }

    public function setOrganization($msID)
    {
        $this->arBodyPost["organization"] = MSTools::constructEntityMetaArray($msID, 'organization');

        return $this;
    }

    public function setAgent($msID)
    {
        $this->arBodyPost["agent"] = MSTools::constructEntityMetaArray($msID, 'counterparty');

        return $this;
    }

    public function setStore($msID)
    {
        $this->arBodyPost["store"] = MSTools::constructEntityMetaArray($msID, 'store');

        return $this;
    }

    public function setOwner($msID)
    {
        $this->arBodyPost["owner"] = MSTools::constructEntityMetaArray($msID, 'employee');

        return $this;
    }

    public function setAttributeInBody($id, $value)
    {
        $isChange = false;
        if (isset($this->arBodyPost['attributes'])) {
            foreach ($this->arBodyPost['attributes'] as &$arAttribute) {
                if ($arAttribute['id'] == $id) {
                    $arAttribute['value'] = $value;
                    $isChange = true;
                }
            }
        }

        if (!$isChange) {
            $this->arBodyPost['attributes'][] = array_merge(MSTools::constructAttributeMetaArray($id, static::CODE_ENTITY), [
                'id' => $id,
                'value' => $value
            ]);
        }

        return $this;
    }

    public function getListAllAttributes()
    {
        return $this->connect->get('/entity/' . static::CODE_ENTITY . '/metadata/attributes');
    }

    public function groupDelete()
    {
        return $this->connect->post('/entity/' . static::CODE_ENTITY . '/delete', $this->arBodyPost);
    }

    public function create()
    {
        $this->modified();

        return $this;
    }
}