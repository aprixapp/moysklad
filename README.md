# Библиотека для работы с МойСклад через JSON API 1.2

### Установка пакета:

```bash
composer require aprixapp/moysklad
```

### Быстрый старт

Создание нового подключения:
```php
use AprixApp\MoySklad\MSConnect; 

$login = '****@****';
$password = "******";

$msConnect = new MSConnect([
    'login' => $login,
    'password' => $password
]);
```
или
```php
use AprixApp\MoySklad\MSConnect; 

$accessToken = '********************';

$msConnect = new MSConnect([
    'token' => $accessToken
]);
```
Пример получения списка списка сущностей (ассортимент):
```php
use AprixApp\MoySklad\Entities\Assortment;

$assortment = new Assortment($msConnect);
$rows = $assortment
    ->setFilter([
        'stockStore' => [
            "https://api.moysklad.ru/api/remap/1.2/entity/store/19719e08-5d5d-11ec-0a80-099500039a1b"
        ]
    ])
    ->get()
    ->getResponseRows();
```
