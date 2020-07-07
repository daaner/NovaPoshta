# Common - API Справочники
```php
use Daaner\NovaPoshta\Models\Common;
```

<a name="content"></a>
## Содержание
- [x] [Виды временных интервалов](/docs/Common.md#getTimeIntervals)
- [x] [Виды груза](/docs/Common.md#getCargoTypes)
- [x] [Виды обратной доставки груза](/docs/Common.md#getBackwardDeliveryCargoTypes)
- [x] [Виды паллет](/docs/Common.md#getPalletsList)
- [x] [Виды плательщиков](/docs/Common.md#getTypesOfPayers)
- [x] [Виды плательщиков обратной доставки](/docs/Common.md#getTypesOfPayersForRedelivery)
- [x] [Виды упаковки](/docs/Common.md#getPackList)
- [x] [Виды шин и дисков](/docs/Common.md#getTiresWheelsList)
- [x] [Описания груза](/docs/Common.md#getCargoDescriptionList)
- [x] [Перечень ошибок](/docs/CommonGeneral.md#getMessageCodeText)
- [x] [Технологии доставки](/docs/Common.md#getServiceTypes)
- [x] [Типы контрагентов](/docs/Common.md#getTypesOfCounterparties)
- [x] [Формы оплаты](/docs/Common.md#getPaymentForms)
- [x] [Формы собственности](/docs/Common.md#getOwnershipFormsList)

<a name="content-method"></a>
## Содержание по методам
- [getTimeIntervals($recipientCityRef, $dateTime = null)](#getTimeIntervals)
- [getCargoTypes()](#getCargoTypes)
- [getBackwardDeliveryCargoTypes()](#getBackwardDeliveryCargoTypes)
- [getPalletsList()](#getPalletsList)
- [getTypesOfPayers()](#getTypesOfPayers)
- [getTypesOfPayersForRedelivery()](#getTypesOfPayersForRedelivery)
- [getPackList()](#getPackList)
- [getTiresWheelsList()](#getTiresWheelsList)
- [getCargoDescriptionList($find = null)](#getCargoDescriptionList)
- [getServiceTypes()](#getServiceTypes)
- [getTypesOfCounterparties()](#getTypesOfCounterparties)
- [getPaymentForms()](#getPaymentForms)
- [getOwnershipFormsList()](#getOwnershipFormsList)


---

<a name="getOwnershipFormsList"></a>
#### `getOwnershipFormsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890b) справочника форм собственности
```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getOwnershipFormsList();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getPaymentForms"></a>
#### `getPaymentForms()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890d) справочника формы оплаты
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getPaymentForms();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getTypesOfCounterparties"></a>
#### `getTypesOfCounterparties()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838912) справочника типов контрагентов
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getTypesOfCounterparties();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getServiceTypes"></a>
#### `getServiceTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890e) справочника технологий доставки
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getServiceTypes();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getCargoDescriptionList"></a>
#### `getCargoDescriptionList($find = null)` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838908) справочника описаний груза
```php
$c = new Common;
//работает пагинация, но не поддерживается лимит и язык
$c->setPage(2);
$list = $c->getCargoDescriptionList();

//можно использовать поиск по русским и украинским словам (регистр не важен)
$list = $c->getCargoDescriptionList('Од');

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getTiresWheelsList"></a>
#### `getTiresWheelsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838910) справочника видов шин и дисков
```php
$c = new Common;
//не поддерживается лимит, пагинация и язык
$list = $c->getTiresWheelsList();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getPackList"></a>
#### `getPackList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/582b1069a0fe4f0298618f06) справочника видов упаковки
```php
$c = new Common;
//не поддерживается лимит, пагинация и язык

//работают необязательные фильтры, выбирается значение больше или равно указанного
$c->setLength(3);
$c->setWidth(3);
$c->setHeight(3);
//не документирован, но тоже работает фильт по объемному весу
$c->setVolumetricWeight(15);

//TypeOfPacking уже не используется в АПИ и не добавлен
$list = $c->getPackList();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getTypesOfPayersForRedelivery"></a>
#### `getTypesOfPayersForRedelivery()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838914) справочника видов плательщиков обратной доставки
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getTypesOfPayersForRedelivery();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getTypesOfPayers"></a>
#### `getTypesOfPayers()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913) справочника видов плательщиков доставки
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getTypesOfPayers();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getPalletsList"></a>
#### `getPalletsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913) справочника видов паллет
```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация

$list = $c->getPalletsList();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getBackwardDeliveryCargoTypes"></a>
#### `getBackwardDeliveryCargoTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838907) справочника видов обратной доставки груза
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getBackwardDeliveryCargoTypes();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getCargoTypes"></a>
#### `getCargoTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909) справочника видов груза
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getCargoTypes();

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
---


<a name="getTimeIntervals"></a>
#### `getTimeIntervals($recipientCityRef, $dateTime = null)` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890f) справочника видов временных интервалов
```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация

$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626');
//либо
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626', Carbon::tomorrow()->format('d.m.Y'));

dd($list);
```
[Содержание](#content) [Содержание по методам](#content-method)
