<?php

namespace AprixApp\MoySklad;

abstract  class AbstractMSService
{
    const MS_HOST = 'https://online.moysklad.ru';
    const HREF_MAIN_PART = '/api/remap/1.2';
    const ID_MS_TEMPLATE = '/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/';
}