# TrackingDocument

```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```

## Содержание


## Все методы модели
- [getStatusDocuments()](#getStatusDocuments)
- [checkTTN()](#checkTTN)
- [getStatusTTN()](#getStatusTTN)

---

### `getStatusDocuments()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee) полной информации по ТТН
```php
$doc = array();

//в массиве одна или несколько ТТН с отдельными телефонами
array_push($doc, ['DocumentNumber' => 'ttn1', 'Phone' => 'phone1']);
array_push($doc, ['DocumentNumber' => 'ttn2', 'Phone' => 'phone2']);

$np = new TrackingDocument;
$getStatusDocuments = $np->getStatusDocuments($doc);

dd($getStatusDocuments);
array:3 [▼
  "success" => true
  "result" => array:2 [▼
    0 => array:13 [▶]
    1 => array:75 [▶]
  ]
  "info" => array:1 [▶]
]
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `checkTTN()`
Проверка одной/массива накладных с необязательным указанием общего телефона
```php
$data = ['20450xxxx701xx', '20450xxxx227xx', '20450xxxx886xx'];
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
array:3 [▼
  "success" => true
  "result" => array:3 [▼
    0 => array:6 [▶]
    1 => array:6 [▶]
    2 => array:6 [▼
      "Number" => "20450xxxx886xx"
      "StatusCode" => "102"
      "Status" => "Відмова від отримання"
      "StatusLocale" => "Возврат посылки по времени (102)"
      "ActualDeliveryDate" => "2020-07-01 00:00:00"
      "NewTTN" => "59000xxxx606xx"
    ]
  ]
  "info" => array:2 [▶]
]
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
