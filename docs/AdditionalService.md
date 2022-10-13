# AdditionalService

```php
use Daaner\NovaPoshta\Models\AdditionalService;
```

## Содержание
- [x] [Проверка возможности создания заявки на возврат](AdditionalService.md#CheckPossibilityCreateReturn)
- [x] [Получение списка причин возврата](AdditionalService.md#getReturnReasons)
- [x] [Получение списка подтипов причины возврата](AdditionalService.md#getReturnReasonsSubtypes)
- [x] [Получение списка заявок на возврат](AdditionalService.md#getReturnOrdersList)


## Все методы модели
- [CheckPossibilityCreateReturn($ttn)](#CheckPossibilityCreateReturn)
- [getReturnReasons()](#getReturnReasons)
- [getReturnReasonsSubtypes($ref = null)](#getReturnReasonsSubtypes)
- [getReturnOrdersList()](#getReturnOrdersList)

---


### `CheckPossibilityCreateReturn($ttn)`
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
