<?php

namespace AprixApp\MoySklad;

abstract class MSReport extends MSElement
{
    const ELEMENT_PART_HREF = '/report';

    public function __construct(MSConnect $connect)
    {
        parent::__construct($connect);
        $this->partHref = static::ELEMENT_PART_HREF . '/' . static::CODE_ENTITY;
    }

    public function setGroupBy(string $type)
    {
        if (!empty($type)) {
            $this->arQuery['groupBy'] = $type;
        }

        return $this;
    }
}