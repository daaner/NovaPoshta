# InternetDocument

```php
use Daaner\NovaPoshta\Models\InternetDocument;
```

## Содержание
- [x] [Получение списка всех ЭН](InternetDocument.md#getDocumentList)
- [x] [Создать экспресс-накладную](InternetDocument.md#save)
- [x] [Удалить экспресс-накладные](InternetDocument.md#delete)
- [x] [Получить денежные переводы](InternetDocument.md#getMoneyTransferDocuments)
- [x] [Прогноз даты доставки груза](InternetDocument.md#getDocumentDeliveryDate)
- [x] [Прогноз стоимости доставки груза](InternetDocument.md#getDocumentPrice)
- [x] [Редактирование экспресс-накладной](InternetDocument.md#edit) (НЕ ПРОВЕРЕНО)
- [x] [Получение PDF по накладным либо реестру](InternetDocument.md#getPDF)


## Все методы модели
- [getDocumentList()](#getDocumentList)
- [save($description = null)](#save)
- [delete($description = null)](#delete)
- [getMoneyTransferDocuments($from = null, $to = null)](#getMoneyTransferDocuments)
- [getDocumentDeliveryDate($CitySender, $CityRecipient)](#getDocumentDeliveryDate)
- [getDocumentPrice($CitySender, $CityRecipient)](#getDocumentPrice)
- [edit($description = null)](#edit)
- [getPDF($$DocumentRefs, $getStreamFile)](#getPDF)

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
$np->setDateTimeFrom('11-07-2020'); //Если не указано `setDateTimeFrom` - значение будет таким же, как `setDateTimeTo`
$np->setDateTimeTo('11-07-2020'); //Если не указано `setDateTimeTo` - значение будет сегодняшним числом
$np->showFullList(); // отобразить полный список (игнорируется лимит и постраничная разбивка)
$np->showRedeliveryMoney(); // Отобразить полный список ЭН с обратной доставкой. Требуется указание даты DateTimeFrom и DateTimeTo
$np->showUnassembledCargo(); // Отобразить полный список всех актуальных ЭН (по которым не написано заявление на возврат или утилизацию) не забранных получателями посылок. Требуется указание даты DateTimeFrom и DateTimeTo

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

//указание веса посылки или посылок (если более 1 места)
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
Получить данные о платежах за определенный период

```php
$intDoc = new InternetDocument;

//можно переопределить API, иначе возьмет данные с конфига
$intDoc->setAPI('c74***25'); //необязательно

$intDoc->setLimit(100); //необязательно
$intDoc->setPage(2);    //необязательно

$transfer = $intDoc->getMoneyTransferDocuments();

//либо можно указать диапазон
$from = '2021-01-01 00:00:00'; //Carbon, string, date, null
$from = '2021-02-01 00:00:00'; //Carbon, string, date, null
$transfer = $intDoc->getMoneyTransferDocuments($from, $to);

dd($transfer);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getDocumentDeliveryDate()`
[Прогноз](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a941c714-8512-11ec-8ced-005056b2dbe1) даты доставки груза

```php
$intDoc = new InternetDocument;

$CitySender = '8d5a980d-391c-11dd-90d9-001a92567626'; //город отправителя
$CityRecipient = 'db5c88f5-391c-11dd-90d9-001a92567626'; //город получателя

//НЕОБЯЗАТЕЛЬНЫЕ ПАРАМЕТРЫ
$intDoc->setDateTime('1/1/2028'); //Если не указать, посчитает с текущего дня и времени
$intDoc->setServiceType('WarehouseDoors'); //Тип отправки (по умолчанию в конфиге `service_type`)

$forecast = $intDoc->getDocumentDeliveryDate($CitySender, $CityRecipient);

dd($forecast);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getDocumentPrice()`
[Прогноз](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a91f115b-8512-11ec-8ced-005056b2dbe1) стоимости доставки груза

```php
$intDoc = new InternetDocument;

$CitySender = '8d5a980d-391c-11dd-90d9-001a92567626'; //город отправителя
$CityRecipient = 'db5c88f5-391c-11dd-90d9-001a92567626'; //город получателя

//НЕОБЯЗАТЕЛЬНЫЕ ПАРАМЕТРЫ
$intDoc->setDateTime('1/1/2028'); //Если не указать, посчитает с текущего дня
$intDoc->setServiceType('WarehouseDoors'); //Тип отправки (по умолчанию в конфиге `service_type`)
$intDoc->setWeight('3'); //Вес посылки (по умолчанию 1)
$intDoc->setCargoType('Parcel'); //Тип посылки (по умолчанию в конфиге `cargo_type`)
$adr->setCost(500); // Оценочная стоимость

//ЗЫ: Есть еще куча всяких условий у них, я добавил только популярные

$forecast = $intDoc->getDocumentPrice($CitySender, $CityRecipient);

dd($forecast);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `edit()`
[Редактирование](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a98a4354-8512-11ec-8ced-005056b2dbe1) экспресс-накладной

__НЕ ПРОВЕРЕНО__

```php
$intDoc = new InternetDocument;
$description = 'Изменение';
$np->setAPI('c9********fd');
$intDoc->setRef('123');

// остальные параметры, такие же как и при создании накладной

$edited = $intDoc->edit($description);

dd($edited);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getPDF()`
Получение PDF по накладной или массиву накладных либо реестру

При большом кол-ве генерируемых PDF увеличивайте значение `config('novaposhta.http_retry_delay')`.

```php
$intDoc = new InternetDocument;
$np->setAPI('c9********fd');

// номер ТТН либо Ref
$ttns = '20450600000000';
//либо массивом
$ttns = [
    '20450600000000',
    '00000000-0000-0000-0000-000000000000'
];
// реестр тоже можно передавать как номером, так и Ref'ом
$ttns = '105-00000000'; // Это номер реестра


// НЕ обязательные установки
$np->setCopies(1); //кол-во копий (по умолчанию: 1)
$np->setPrintForm('Marking_100x100'); // макет шаблона (по умолчанию: 'Document_new')

// Установка, что данный Ref является реестром. Копия всегда одна.
$np->setThisIsScansheet();
// Реестр создается по ориентации из конфига config('novaposhta.scan_sheet_orientation'), либо можно указать вручную
$np->setThisIsScansheet('portrait');


// Установки, которые особо не нужны или автоматически подставляющиеся,
// в зависимости от макета шаблона.
$np->setPageFormat('A5'); // размер страницы (по умолчанию: 'A4')
$np->setPosition(1); // установка позиции (по умолчанию: '1')
$np->setType('pdf'); // установка позиции (по умолчанию: 'pdf')

// ответ массивом, где в ключе `$data['result']` тело PDF файла
// файл получен и можно вывести, если `$data['success'] == true`, иначе в `$data['result']` пусто
$data = $intDoc->getPDF($ttns, false);
dd($data);

// Сразу открытие (при `$data['success'] == true`) файла
$data = $intDoc->getPDF($ttns, true);
return $data;

```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
