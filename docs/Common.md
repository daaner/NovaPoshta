# Common - API Справочники
```php
use Daaner\NovaPoshta\Models\Common;
```

<a name="content"></a>

## Содержание
- [x] [Виды временных интервалов](Common.md#gettimeintervals)
- [x] [Виды груза](Common.md#getcargotypes)
- [x] [Виды обратной доставки груза](Common.md#getbackwarddeliverycargotypes)
- [x] [Виды паллет](Common.md#getpalletslist)
- [x] [Виды плательщиков](Common.md#gettypesofpayers)
- [x] [Виды плательщиков обратной доставки](Common.md#gettypesofpayersforredelivery)
- [x] [Виды упаковки](Common.md#getpacklist)
- [x] [Виды шин и дисков](Common.md#gettireswheelslist)
- [x] [Описания груза](Common.md#getcargodescriptionlist)
- [x] [Перечень ошибок](CommonGeneral.md#getmessagecodetext)
- [x] [Технологии доставки](Common.md#getservicetypes)
- [x] [Типы контрагентов](Common.md#gettypesofcounterparties)
- [x] [Формы оплаты](Common.md#getpaymentforms)
- [x] [Формы собственности](Common.md#getownershipformslist)

<a name="content-method"></a>

## Все методы модели
- [getTimeIntervals($recipientCityRef, $dateTime = null)](#gettimeintervals)
- [getCargoTypes()](#getcargotypes)
- [getBackwardDeliveryCargoTypes()](#getbackwarddeliverycargotypes)
- [getPalletsList()](#getpalletslist)
- [getTypesOfPayers()](#gettypesofpayers)
- [getTypesOfPayersForRedelivery()](#gettypesofpayersforredelivery)
- [getPackList()](#getpacklist)
- [getTiresWheelsList()](#gettireswheelslist)
- [getCargoDescriptionList($find = null)](#getcargodescriptionlist)
- [getServiceTypes()](#getservicetypes)
- [getTypesOfCounterparties()](#gettypesofcounterparties)
- [getPaymentForms()](#getpaymentforms)
- [getOwnershipFormsList()](#getownershipformslist)


---

<a name="getownershipformslist"></a>

#### `getOwnershipFormsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890b) справочника форм собственности
```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getOwnershipFormsList();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getpaymentforms"></a>

#### `getPaymentForms()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890d) справочника формы оплаты
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getPaymentForms();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="gettypesofcounterparties"></a>

#### `getTypesOfCounterparties()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838912) справочника типов контрагентов
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getTypesOfCounterparties();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getservicetypes"></a>

#### `getServiceTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890e) справочника технологий доставки
```php
$c = new Common;
//локализация справочника (ru/ua)
$c->setLanguage('ru');
$list = $c->getServiceTypes();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getcargodescriptionlist"></a>

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
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="gettireswheelslist"></a>

#### `getTiresWheelsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838910) справочника видов шин и дисков
```php
$c = new Common;
//не поддерживается лимит, пагинация и язык
$list = $c->getTiresWheelsList();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getpacklist"></a>

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
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="gettypesofpayersforredelivery"></a>

#### `getTypesOfPayersForRedelivery()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838914) справочника видов плательщиков обратной доставки
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getTypesOfPayersForRedelivery();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="gettypesofpayers"></a>

#### `getTypesOfPayers()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913) справочника видов плательщиков доставки
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getTypesOfPayers();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getpalletslist"></a>

#### `getPalletsList()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913) справочника видов паллет
```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация

$list = $c->getPalletsList();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getbackwarddeliverycargotypes"></a>

#### `getBackwardDeliveryCargoTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838907) справочника видов обратной доставки груза
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getBackwardDeliveryCargoTypes();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="getcargotypes"></a>

#### `getCargoTypes()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909) справочника видов груза
```php
$c = new Common;
//не поддерживается лимит, пагинация
//локализация справочника (ru/ua)
$c->setLanguage('ru');

$list = $c->getCargoTypes();

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
***


<a name="gettimeintervals"></a>

#### `getTimeIntervals($recipientCityRef, $dateTime = null)` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890f) справочника видов временных интервалов
```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация

$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626');
//либо
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626', Carbon::tomorrow()->format('d.m.Y'));

dd($list);
```
[Содержание](Common.md#content) [Методы модели](Common.md#content-method)
