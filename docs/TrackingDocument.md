# TrackingDocument

```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```

## Содержание
- [x] [Получение полной инфо об ЭН](TrackingDocument.md#getStatusDocuments)
- [x] [Проверка одной/массива ЭН](TrackingDocument.md#checkTTN)
- [x] [Быстрая проверка одной/массива ЭН](TrackingDocument.md#getStatusTTN)

## Все методы модели
- [getStatusDocuments()](#getStatusDocuments)
- [checkTTN()](#checkTTN)
- [getStatusTTN()](#getStatusTTN)

---

### `getStatusDocuments()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee) полной информации по ТТН
```php

$doc = '20450296339688';
// либо
$doc = '20450296339688, 20450296339742';
//либо в массиве одна или несколько ТТН с отдельными телефонами
$doc = array();
array_push($doc, ['DocumentNumber' => 'ttn1', 'Phone' => 'phone1']);
array_push($doc, ['DocumentNumber' => 'ttn2', 'Phone' => 'phone2']);

$np = new TrackingDocument;
$getStatusDocuments = $np->getStatusDocuments($doc);

dd($getStatusDocuments);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `checkTTN()`
Проверка одной/массива накладных с необязательным указанием общего телефона
```php
// Берутся только значения массива как ЭН
$data = ['20450xxxx701xx', '20450xxxx227xx', '20450xxxx886xx'];
// либо
$data = [
  15 => '20450xxxx701xx',
  "100500" => '20450xxxx227xx',
  '20450xxxx886xx'
];

$np = new TrackingDocument;
$info = $np->checkTTN($data);
//или
$info = $np->checkTTN($data, '380671234567');
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getStatusTTN()`
Быстрая проверка одной/массива накладных с получением статуса и возвратной накладной `NewTTN` (при возврате)
```php
$data = ['20450xxxx701xx', '20450xxxx227xx', '20450xxxx886xx'];
$np = new TrackingDocument;
$info = $np->getStatusTTN($data);

dd($info);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
