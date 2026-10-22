# TrackingDocument

```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```

Номери ТТН можна передавати з пробілами. Під час запиту кожна ТТН очищається від усіх символів, крім цифр.
Якщо НП введе літери - треба буде виправити.

## Зміст
- [x] [Отримання повної інформації про ЕН](TrackingDocument.md#getStatusDocuments)
- [x] [Перевірка однієї/масиву ЕН](TrackingDocument.md#checkTTN)
- [x] [Швидка перевірка однієї/масиву ЕН](TrackingDocument.md#getStatusTTN)

## Усі методи моделі
- [getStatusDocuments($documents)](#getStatusDocuments)
- [checkTTN($ttns, $phone = null)](#checkTTN)
- [getStatusTTN($ttns, $phone = null)](#getStatusTTN)

---

### `getStatusDocuments()`
[Отримання](https://developers.novaposhta.ua/view/model/a99d2f28-8512-11ec-8ced-005056b2dbe1/method/a9ae7bc9-8512-11ec-8ced-005056b2dbe1) повної інформації по ТТН

```php
$doc = '20450296339688';
// або
$doc = '20450296339688, 20450296339742';
//або
$doc = ['20450296339688, 20450296339742'];
//або
$doc = [
    0 => '20450296339688',
    '100500' => '20450296339742'
];
//або в масиві одна чи кілька ТТН з окремими телефонами
$doc = array();
array_push($doc, ['DocumentNumber' => 'ttn1', 'Phone' => 'phone1']);
array_push($doc, ['DocumentNumber' => 'ttn2', 'Phone' => 'phone2']);

$np = new TrackingDocument;
$getStatusDocuments = $np->getStatusDocuments($doc);

dd($getStatusDocuments);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `checkTTN()`
Перевірка однієї/масиву накладних з необов'язковим зазначенням спільного телефону

```php
// Як ЕН беруться лише значення масиву
$data = ['20450xxxx701xx', '20450xxxx227xx', '20450xxxx886xx'];
// або
$data = [
  15 => '20450xxxx701xx',
  "100500" => '20450xxxx227xx',
  '20450xxxx886xx'
];

$np = new TrackingDocument;
$info = $np->checkTTN($data);
//або
$info = $np->checkTTN($data, '380671234567');

dd($info);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getStatusTTN()`
Швидка перевірка однієї/масиву накладних з отриманням статусу та зворотної накладної `NewTTN` (при поверненні)

```php
$data = ['20450xxxx701xx', '20450xxxx227xx', '20450xxxx886xx'];
$np = new TrackingDocument;
$info = $np->getStatusTTN($data);

dd($info);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
