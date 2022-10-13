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
- [x] [Проверка возможности создания заявки на переадресацию отправки](AdditionalService.md#save)


## Все методы модели
- [CheckPossibilityCreateReturn($ttn)](#CheckPossibilityCreateReturn)
- [getReturnReasons()](#getReturnReasons)
- [getReturnReasonsSubtypes($ref = null)](#getReturnReasonsSubtypes)
- [getReturnOrdersList()](#getReturnOrdersList)
- [checkPossibilityForRedirecting($ttn)](#checkPossibilityForRedirecting)
- [save($ttn)](#save)

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
