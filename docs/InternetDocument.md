# InternetDocument

```php
use Daaner\NovaPoshta\Models\InternetDocument;
```

## Содержание
- [x] [Получение списка всех ЭН](InternetDocument.md#getDocumentList)
- [x] [Создать экспресс-накладную](InternetDocument.md#save)
- [x] [Удалить экспресс-накладные](InternetDocument.md#delete)
- [x] [Получить денежные переводы](InternetDocument.md#getMoneyTransferDocuments)


## Все методы модели
- [getDocumentList()](#getDocumentList)
- [save($description = null)](#save)
- [delete($description = null)](#delete)
- [getMoneyTransferDocuments($from = null, $to = null)](#getMoneyTransferDocuments)

---

### `getDocumentList()`
[Получение](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9d22b34-8512-11ec-8ced-005056b2dbe1) списка всех ЭН

```php

$np = new InternetDocument;

// НЕ обязательные параметры
$np->setLimit(5);
$np->setPage(2);
//выборка по конкретной дате (выборка за период тогда не работает)
$np->setDateTime('10-05-2020');
//или выборка за период
$np->setDateTimeFrom('11-07-2020'); //eсли не указано `setDateTimeFrom` - значение будет таким же, как `setDateTimeTo`
$np->setDateTimeTo('11-07-2020'); //eсли не указано `setDateTimeTo` - значение будет сегодняшним числом
$np->showFullList(); // отобразить полный список (игнорируется лимит и постраничная разбивка)
$np->showRedeliveryMoney(); // отобразить полный список ЭН с обратной доставкой. Требуется указание даты DateTimeFrom и DateTimeTo
$np->showUnassembledCargo(); // отобразить полный список всех актуальных ЭН (по которым не написано заявление на возврат или утилизацию) не забранных получателями посылок. Требуется указание даты DateTimeFrom и DateTimeTo


$lists = $np->getDocumentList();

dd($lists);

```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***

### `save()`
[Создать](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a965630e-8512-11ec-8ced-005056b2dbe1) экспресс-накладную

Для более полного понимания и передачи данных - смотрите трейты модели, ниже описано не все

```php

$np = new InternetDocument;
//не забываем про метод setApi, чтоб создать ЭН от другого отправителя
$np->setAPI('c9********fd');

$sender = [
  'Sender' => 'a4***6b',
  'CitySender' => 'db5c88d0-391c-11dd-90d9-001a92567626',
  'SenderAddress' => '404***2cf',
  'ContactSender' => '86c***c6b',
  'SendersPhone' => '380965775815',
];
$np->setSender($sender);

/**
  * Вариант доставки:
  * WarehouseDoors - адресная доставка
  * WarehouseWarehouse - доставка на отделение
  * DoorsWarehouse - Двери-Склад
  * DoorsDoors - Двери-Двери
  */
$np->setServiceType('WarehouseDoors');

/**
  * Получателя можно создать двумя путями
  * при помощи REF или строкой
  *
  * Учтите, что строкой, случайно можно отправить в город/село с таким-же названием,
  * хотя НП постоянно уникализирует названия для удобного создания строкой
  * полное название лучше брать из справочника (обновляйте хотя бы раз в неделю)
  *
  */

// идентификаторами
$recipient = [
  'Recipient' => '76****33',
  'CityRecipient' => '8d5a980d-391c-11dd-90d9-001a92567626',
  'RecipientAddress' => '2907******b8d',
  'ContactRecipient' => 'e5*****33',
  'RecipientsPhone' => '380997979789',
];

// ЭН строкой
$recipient = [
  'RecipientsPhone' => '380997979789',
  'RecipientName' => 'Иванов Иван Иванович',
  'RecipientCityName' => 'Киев',
  'RecipientArea' => '',
  'RecipientAreaRegions' => '',
  'RecipientAddressName' => '7495',
  'RecipientHouse' => '',
  'RecipientFlat' => '',
];

$np->setRecipient($recipient);
//наложный платеж
$np->setBackwardDeliveryData(386);

$np->setAdditionalInformation('Добавление информации');

//указание веса посылки или посылкок (если более 1 места)
$np->setOptionsSeat([1, 5, 10, 11]);
$np->setOptionsSeat(5);

$createTTN = $np->save('Заявка №500');

dd($createTTN);

```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***

### `delete()`
[Удалить](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9f43ff1-8512-11ec-8ced-005056b2dbe1) экспресс-накладную или массив накладных

```php
$intDoc = new InternetDocument;

$documents = '677e592b-1884-11eb-8513-b88303659df5';
//или массивом и неважно какие ключи, берутся только значения
$documents = [
  15 =>'677e592b-1884-11eb-8513-b88303659df5',
  "100500" => '50184bff-1884-11eb-8513-b88303659df5'
];

$deleted = $intDoc->delete($documents);

dd($deleted);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***

### `getMoneyTransferDocuments()`
__НЕ ДОКУМЕНТИРОВАНО В ОФИЦИАЛЬНОЙ ДОКУМЕНТАЦИИ__

Получить данные о платежах за определенный период

```php
$intDoc = new InternetDocument;

//можно переопределить API, иначе возьмет данные с конфига
$intDoc->setAPI('c74***25'); //не обязательно

$intDoc->setLimit(100); //не обязательно
$intDoc->setPage(2);    //не обязательно

$transfer = $intDoc->getMoneyTransferDocuments();

//либо можно указать диапазон
$from = '2021-01-01 00:00:00'; //Carbon, string, date, null
$from = '2021-02-01 00:00:00'; //Carbon, string, date, null
$transfer = $intDoc->getMoneyTransferDocuments($from, $to);

dd($transfer);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
