# InternetDocument

```php
use Daaner\NovaPoshta\Models\InternetDocument;
```

## Зміст
- [x] [Отримання списку всіх ЕН](InternetDocument.md#getDocumentList)
- [x] [Створити експрес-накладну](InternetDocument.md#save)
- [x] [Видалити експрес-накладні](InternetDocument.md#delete)
- [x] [Отримати грошові перекази](InternetDocument.md#getMoneyTransferDocuments)
- [x] [Прогноз дати доставки вантажу](InternetDocument.md#getDocumentDeliveryDate)
- [x] [Прогноз вартості доставки вантажу](InternetDocument.md#getDocumentPrice)
- [x] [Редагування експрес-накладної](InternetDocument.md#edit)
- [x] [Отримання PDF по накладних або реєстру](InternetDocument.md#getPDF)


## Усі методи моделі
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
[Отримання](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9d22b34-8512-11ec-8ced-005056b2dbe1) списку всіх ЕН

```php
$np = new InternetDocument;

// НЕобов'язкові параметри
$np->setLimit(5);
$np->setPage(2);
//вибірка за конкретною датою (вибірка за період тоді не працює)
$np->setDateTime('10-05-2020');
//або вибірка за період
$np->setDateTimeFrom('11-07-2020'); //Якщо не вказано `setDateTimeFrom` - значення буде таким самим, як `setDateTimeTo`
$np->setDateTimeTo('11-07-2020'); //Якщо не вказано `setDateTimeTo` - значенням буде сьогоднішня дата
$np->showFullList(); // показати повний список (ліміт і посторінкова розбивка ігноруються)
$np->showRedeliveryMoney(); // Показати повний список ЕН зі зворотною доставкою. Потрібно вказати дати DateTimeFrom і DateTimeTo
$np->showUnassembledCargo(); // Показати повний список усіх актуальних ЕН (за якими не подано заяву на повернення чи утилізацію) з посилками, не забраними одержувачами. Потрібно вказати дати DateTimeFrom і DateTimeTo

$lists = $np->getDocumentList();

dd($lists);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***

### `save()`
[Створити](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a965630e-8512-11ec-8ced-005056b2dbe1) експрес-накладну

Для повнішого розуміння та передачі даних дивіться трейти моделі, нижче описано не все

```php
$np = new InternetDocument;
//не забуваємо про метод setApi, щоб створити ЕН від іншого відправника
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
  * Варіант доставки:
  * WarehouseDoors - адресна доставка
  * WarehouseWarehouse - доставка у відділення
  * DoorsWarehouse - Двері-Склад
  * DoorsDoors - Двері-Двері
  */
$np->setServiceType('WarehouseDoors');

/**
  * Одержувача можна створити двома шляхами:
  * за допомогою REF або рядком
  *
  * Врахуйте, що рядком можна випадково відправити в місто/село з такою самою назвою,
  * хоча НП постійно уніфікує назви для зручного створення рядком.
  * Повну назву краще брати з довідника (оновлюйте хоча б раз на тиждень)
  *
  */

// ідентифікаторами
$recipient = [
  'Recipient' => '76****33',
  'CityRecipient' => '8d5a980d-391c-11dd-90d9-001a92567626',
  'RecipientAddress' => '2907******b8d',
  'ContactRecipient' => 'e5*****33',
  'RecipientsPhone' => '380997979789',
];

// ЕН рядком
$recipient = [
  'RecipientsPhone' => '380997979789',
  'RecipientName' => 'Іванов Іван Іванович',
  'RecipientCityName' => 'Київ',
  'RecipientArea' => '',
  'RecipientAreaRegions' => '',
  'RecipientAddressName' => '7495',
  'RecipientHouse' => '',
  'RecipientFlat' => '',
];

$np->setRecipient($recipient);

//Платник доставки
//Вказувати не обов'язково, значення береться з конфігу
$np->setPayerType('Sender');

//накладений платіж або Контроль оплати для підприємців
//"Контроль оплати" має пріоритет перед накладеним платежем!!!
$np->setBackwardDeliveryData(386);
//або
$np->setAfterpaymentOnGoodsCost(386);

$np->setAdditionalInformation('Додаткова інформація');

//вага посилки або посилок (якщо більше 1 місця)
$np->setOptionsSeat([1, 5, 10, 11]);
$np->setOptionsSeat(5);

$createTTN = $np->save('Заявка №500. Одяг'); //Опис (назва) посилки

dd($createTTN);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***

### `delete()`
[Видалити](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9f43ff1-8512-11ec-8ced-005056b2dbe1) експрес-накладну або масив накладних

```php
$intDoc = new InternetDocument;

$documents = '677e592b-1884-11eb-8513-b88303659df5';
//або масивом, ключі неважливі - беруться лише значення
$documents = [
  15 =>'677e592b-1884-11eb-8513-b88303659df5',
  "100500" => '50184bff-1884-11eb-8513-b88303659df5'
];

$deleted = $intDoc->delete($documents);

dd($deleted);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***

### `getMoneyTransferDocuments()`
Отримати дані про платежі за певний період

```php
$intDoc = new InternetDocument;

//можна перевизначити API, інакше візьме дані з конфігу
$intDoc->setAPI('c74***25'); //не обов'язково

$intDoc->setLimit(100); //не обов'язково
$intDoc->setPage(2);    //не обов'язково

$transfer = $intDoc->getMoneyTransferDocuments();

//або можна вказати діапазон
$from = '2021-01-01 00:00:00'; //Carbon, string, date, null
$from = '2021-02-01 00:00:00'; //Carbon, string, date, null
$transfer = $intDoc->getMoneyTransferDocuments($from, $to);

dd($transfer);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getDocumentDeliveryDate()`
[Прогноз](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a941c714-8512-11ec-8ced-005056b2dbe1) дати доставки вантажу

```php
$intDoc = new InternetDocument;

$CitySender = '8d5a980d-391c-11dd-90d9-001a92567626'; //місто відправника
$CityRecipient = 'db5c88f5-391c-11dd-90d9-001a92567626'; //місто одержувача

//НЕОБОВ'ЯЗКОВІ ПАРАМЕТРИ
$intDoc->setDateTime('1/1/2028'); //Якщо не вказати, порахує від поточного дня й часу
$intDoc->setServiceType('WarehouseDoors'); //Тип відправлення (за замовчуванням у конфігу `service_type`)

$forecast = $intDoc->getDocumentDeliveryDate($CitySender, $CityRecipient);

dd($forecast);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getDocumentPrice()`
[Прогноз](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a91f115b-8512-11ec-8ced-005056b2dbe1) вартості доставки вантажу

```php
$intDoc = new InternetDocument;

$CitySender = '8d5a980d-391c-11dd-90d9-001a92567626'; //місто відправника
$CityRecipient = 'db5c88f5-391c-11dd-90d9-001a92567626'; //місто одержувача

//НЕОБОВ'ЯЗКОВІ ПАРАМЕТРИ
$intDoc->setDateTime('1/1/2028'); //Якщо не вказати, порахує від поточного дня
$intDoc->setServiceType('WarehouseDoors'); //Тип відправлення (за замовчуванням у конфігу `service_type`)
$intDoc->setWeight('3'); //Вага посилки (за замовчуванням 1)
$intDoc->setCargoType('Parcel'); //Тип посилки (за замовчуванням у конфігу `cargo_type`)
$adr->setCost(500); // Оціночна вартість

//P.S.: У НП є ще купа різних умов, я додав лише популярні

$forecast = $intDoc->getDocumentPrice($CitySender, $CityRecipient);

dd($forecast);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `edit()`
[Редагування](https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a98a4354-8512-11ec-8ced-005056b2dbe1) експрес-накладної

Редагує накладну (якщо ще не поїхала)

```php
$intDoc = new InternetDocument;
$description = 'Зміна';
$np->setAPI('c9********fd');
$intDoc->setRef('123');

// інші параметри такі самі, як і під час створення накладної

$edited = $intDoc->edit($description);

dd($edited);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getPDF()`
Отримання PDF по накладній, масиву накладних або реєстру

За великої кількості PDF, що генеруються, збільшуйте значення `config('novaposhta.http_retry_delay')`.

```php
$intDoc = new InternetDocument;
$np->setAPI('c9********fd');

// номер ТТН або Ref
$ttns = '20450600000000';
//або масивом
$ttns = [
    '20450600000000',
    '00000000-0000-0000-0000-000000000000'
];
// реєстр теж можна передавати і номером, і Ref'ом
$ttns = '105-00000000'; // Це номер реєстру


// НЕобов'язкові налаштування
$np->setCopies(1); //кількість копій (за замовчуванням: 1)
$np->setPrintForm('Marking_100x100'); // макет шаблону (за замовчуванням: 'Document_new')

// Позначка, що цей Ref є реєстром. Копія завжди одна.
$np->setThisIsScansheet();
// Реєстр створюється з орієнтацією з конфігу config('novaposhta.scan_sheet_orientation'), або її можна вказати вручну
$np->setThisIsScansheet('portrait');


// Налаштування, які не дуже потрібні або підставляються автоматично
// залежно від макета шаблону.
$np->setPageFormat('A5'); // розмір сторінки (за замовчуванням: 'A4')
$np->setPosition(1); // встановлення позиції (за замовчуванням: '1')
$np->setType('pdf'); // тип файлу (за замовчуванням: 'pdf')

// відповідь масивом, де в ключі `$data['result']` тіло PDF-файлу
// файл отримано і його можна вивести, якщо `$data['success'] == true`, інакше в `$data['result']` порожньо
$data = $intDoc->getPDF($ttns, false);
dd($data);

// Одразу відкриття файлу (при `$data['success'] == true`)
$data = $intDoc->getPDF($ttns, true);
return $data;

```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
