# AdditionalService

```php
use Daaner\NovaPoshta\Models\AdditionalService;
```

## Содержание
- [x] [Проверка возможности создания заявки на возврат](AdditionalService.md#CheckPossibilityCreateReturn)
- [x] [Получение списка причин возврата](AdditionalService.md#getReturnReasons)
- [x] [Получение списка подтипов причины возврата](AdditionalService.md#getReturnReasonsSubtypes)
- [x] [Получение списка заявок на возврат](AdditionalService.md#getReturnOrdersList)
- [x] [Проверка возможности создания заявки на переадресацию отправки](AdditionalService.md#checkPossibilityForRedirecting)
- [x] [Создание заявки на возврат](AdditionalService.md#save)
- [x] [Создание заявки на переадресация](AdditionalService.md#saveRedirecting)
- [x] [Получение списка заявок на переадресацию отправлений](AdditionalService.md#getRedirectionOrdersList)


## Все методы модели
- [CheckPossibilityCreateReturn($ttn)](#CheckPossibilityCreateReturn)
- [getReturnReasons()](#getReturnReasons)
- [getReturnReasonsSubtypes($ref = null)](#getReturnReasonsSubtypes)
- [getReturnOrdersList()](#getReturnOrdersList)
- [checkPossibilityForRedirecting($ttn)](#checkPossibilityForRedirecting)
- [save($ttn)](#save)
- [saveRedirecting($ttn)](#saveRedirecting)
- [getRedirectionOrdersList()](#getRedirectionOrdersList)

---


### `CheckPossibilityCreateReturn()`
[Проверка](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1) возможности создания заявки на возврат


```php
$np = new AdditionalService;
// Ключ указывается, если не указан в конфиге или отличен от этого значения
$np->setAPI('3e6****367****bdba****2d87****da');
$ttn = '20450520287825';

$addition = $np->CheckPossibilityCreateReturn($ttn);

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getReturnReasons()`
[Получение](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1) списка причин возврата


```php
$np = new AdditionalService;

$addition = $np->getReturnReasons();

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getReturnReasonsSubtypes()`
[Получение](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1) списка подтипов причины возврата


```php
$np = new AdditionalService;

$addition = $np->getReturnReasonsSubtypes();
//либо, если другие причины (в конфиге значение по умолчанию), можно передать Ref
$addition = $np->getReturnReasonsSubtypes($ref);

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getReturnOrdersList()`
[Получение](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a82d087c-8512-11ec-8ced-005056b2dbe1) списка заявок на возврат


```php
$np = new AdditionalService;

$addition = $np->getReturnOrdersList();

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `checkPossibilityForRedirecting()`
[Проверка](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8d29fc2-8512-11ec-8ced-005056b2dbe1) возможности создания заявки на переадресацию отправки

```php
$np = new AdditionalService;
$ttn = '20450520287825';

$addition = $np->checkPossibilityForRedirecting($ttn);

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `save()`
Создание заявки на возврат посылки.

[Возврат](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7fb4a3a-8512-11ec-8ced-005056b2dbe1) на адрес отправителя

[Возврат](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/5a64f960-e7fa-11ec-a60f-48df37b921db) на новый адрес отделения

[Возврат](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/175baec3-8f0d-11ec-8ced-005056b2dbe1) на новый адрес по адресной доставке


```php
$np = new AdditionalService;
$ttn = '206004560074695';
$np->setApi('...');

// на отделение не из списка отправителя (из справочника отделений)
$np->setRecipientWarehouse('137db83c-e6a9-11e5-899e-005056887b8d');

// либо на адрес отправителя (адрес для возврата, брать с ответа в методе CheckPossibilityCreateReturn)
$np->setReturnAddressRef('00000000-0000-0000-0000-000000000000');

// либо на новый адрес, указанный массивом
$newAddress = [
    'settlement' => '00000000-0000-0000-0000-000000000000', //Ref населеного пункта
    'street' => '00000000-0000-0000-0000-000000000000', //Ref улицы
    'building' => '4', //Номер дома
    'other' => '2', //Квартира или другое описание
];
$np->setRecipientSettlement($newAddress);

// ДОПОЛНИТЕЛЬНО! Добавлено для простоты оформления .
// Если не указан ни один пункт (ни setRecipientWarehouse, ни setReturnAddressRef, ни setRecipientSettlement),
// Возврат оформляется на отделение Ref которого берется из конфига `config('novaposhta.ref_return_warehouse')`

// НЕОБЯЗАТЕЛЬНЫЕ ПОЛЯ, отличные от значения в конфиге
$np->setReason('00000000-0000-0000-0000-000000000000'); //Ref причины из справочника
$np->setSubtypeReason('00000000-0000-0000-0000-000000000000'); //Ref подтипа причины из справочника
$np->setNote('Возврат заказа'); //Заметка возврата

$addition = $np->save($ttn);

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `saveRedirecting()`
[Создание](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/98acb0f6-8f0b-11ec-8ced-005056b2dbe1) заявки на переадресацию посылки.

Алиас для метода `save($ttn, true)`, имеет все те же функции, что и метод `save`

```php
$np = new AdditionalService;
$ttn = '206004560074695';
$np->setApi('...');

// на отделение не из списка отправителя (из справочника отделений)
$np->setRecipientWarehouse('137db83c-e6a9-11e5-899e-005056887b8d');

// либо на адрес отправителя (адрес для возврата, брать с ответа в методе CheckPossibilityCreateReturn)
$np->setReturnAddressRef('00000000-0000-0000-0000-000000000000');

// либо на новый адрес, указанный массивом
$newAddress = [
    'settlement' => '00000000-0000-0000-0000-000000000000', //Ref населеного пункта
    'street' => '00000000-0000-0000-0000-000000000000', //Ref улицы
    'building' => '4', //Номер дома
    'other' => '2', //Квартира или другое описание
];
$np->setRecipientSettlement($newAddress);

$np->setNote('Переадресация заказа'); //Заметка

//
/**
 * ========
 * Отличия от метода save()
 * ========
 */
// Установка плательщика за пересылку (по умолчанию из конфига)
// Учтите, что для оплаты пересылки отправителем - он должен иметь возможность автоматически списать оплату
$np->setPayerType('Recipient'); // необязательный параметр

//Заказчик переадресации (получателю не разрешается изменять данные получателя). По умолчанию `Sender`
$np->setCustomer('Recipient'); // необязательный параметр,

//Тип услуги (DoorsWarehouse, WarehouseWarehouse)
//Будьте осторожны при пересылке с адресной доставки, указывайте правильно
$np->setServiceType('WarehouseWarehouse'); //по умолчанию из конфига (service_type)

// Смена получателя. Игнорируется, если оформляет НЕ отправитель
$recipientData = [
    'Recipient' => '00000000-0000-0000-0000-000000000000', // можно НЕ указывать, если не знаете
    'RecipientContactName' => 'Іванов Іван Іванович',
    'RecipientPhone' => '380681111111',
];
$np->changeRecipientData($recipientData);


$addition = $np->saveRedirecting($ttn);
// либо же
$addition = $np->save($ttn, true);

dd($addition);
```

[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getRedirectionOrdersList()`
[Получение](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8faa2e6-8512-11ec-8ced-005056b2dbe1) списка заявок на переадресацию отправлений


```php
$np = new AdditionalService;
$np->setApi('...');

// Доступные НЕОБЯЗАТЕЛЬНЫЕ методы:
$np->setLimit(3);
$np->setPage(2);
$np->setNumber('102-00010160'); //номер заявки переадресации
$np->setRef('00000000-0000-0000-0000-000000000000'); //Идентификатор заявки на переадресацию (лично у меня не фильтрует)
$np->setDateBegin('2020-11-3'); // дата почти в любом формате, главное чтоб не путались месяца и даты
$np->setDateEnd('9/22/2022');

$addition = $np->getRedirectionOrdersList();

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `delete()`
[Удаление](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a85bb34b-8512-11ec-8ced-005056b2dbe1) заявки
Метод "delete" позволяет удалить:

- заявку на возврат;
- заявку об изменении данных (можно удалить заявку только со статусом «Принято»);
– заявку переадресации.


```php
$np = new AdditionalService;
$np->setApi('...');
$ref = '00000000-0000-0000-0000-000000000000';
$addition = $np->delete($Ref);

dd($addition);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
