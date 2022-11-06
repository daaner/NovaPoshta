# Common - API Справочники
```php
use Daaner\NovaPoshta\Models\Common;
```

## Содержание
- [x] [Виды временных интервалов](Common.md#getTimeIntervals)
- [x] [Виды груза](Common.md#getCargoTypes)
- [x] [Виды обратной доставки груза](Common.md#getBackwardDeliveryCargoTypes)
- [x] [Виды паллет](Common.md#getPalletsList)
- [x] [Виды плательщиков](Common.md#getTypesOfPayers)
- [x] [Виды плательщиков обратной доставки](Common.md#getTypesOfPayersForRedelivery)
- [x] [Виды упаковки](Common.md#getPackList)
- [x] [Виды шин и дисков](Common.md#getTiresWheelsList)
- [x] [Описания груза](Common.md#getCargoDescriptionList)
- [x] [Перечень ошибок](CommonGeneral.md#getMessageCodeText)
- [x] [Технологии доставки](Common.md#getServiceTypes)
- [x] [Типы контрагентов](Common.md#getTypesOfCounterparties)
- [x] [Формы оплаты](Common.md#getPaymentForms)
- [x] [Формы собственности](Common.md#getOwnershipFormsList)
- [x] [Получение данных о менеджере](Common.md#getPersonalManager)

## Все методы модели
- [`getTimeIntervals($recipientCityRef, $dateTime = null)`](#getTimeIntervals)
- [`getCargoTypes()`](#getCargoTypes)
- [`getBackwardDeliveryCargoTypes()`](#getBackwardDeliveryCargoTypes)
- [`getPalletsList()`](#getPalletsList)
- [`getTypesOfPayers()`](#getTypesOfPayers)
- [`getTypesOfPayersForRedelivery()`](#getTypesOfPayersForRedelivery)
- [`getPackList()`](#getPackList)
- [`getTiresWheelsList()`](#getTiresWheelsList)
- [`getCargoDescriptionList($find = null)`](#getCargoDescriptionList)
- [`getServiceTypes()`](#getServiceTypes)
- [`getTypesOfCounterparties()`](#getTypesOfCounterparties)
- [`getPaymentForms()`](#getPaymentForms)
- [`getOwnershipFormsList()`](#getOwnershipFormsList)
- [`getPersonalManager($Ref)`](#getPersonalManager)


---

#### `getOwnershipFormsList()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a754ff0d-8512-11ec-8ced-005056b2dbe1) справочника форм собственности

```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getOwnershipFormsList();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getPaymentForms()`
Получение справочника формы оплаты

```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getPaymentForms();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getTypesOfCounterparties()`
Получение справочника типов контрагентов

```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getTypesOfCounterparties();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getServiceTypes()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6e189f7-8512-11ec-8ced-005056b2dbe1) справочника технологий доставки

```php
$c = new Common;
//локализация справочника не поддерживается Новой Почтой
$list = $c->getServiceTypes();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getCargoDescriptionList()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a697db47-8512-11ec-8ced-005056b2dbe1) справочника описаний груза

```php
$c = new Common;
//работает пагинация, но не поддерживается лимит и локализация
$c->setPage(2);
$list = $c->getCargoDescriptionList();

//можно использовать поиск по русским и украинским словам (регистр не важен)
$list = $c->getCargoDescriptionList('Од');

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getTiresWheelsList()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a66fada0-8512-11ec-8ced-005056b2dbe1) справочника видов шин и дисков

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getTiresWheelsList();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getPackList()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6492db4-8512-11ec-8ced-005056b2dbe1) справочника видов упаковки

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация

//работают необязательные фильтры, выбирается значение больше или равно указанного
$c->setLength(3); // либо $c->setLength('12.0');
$c->setWidth(3);
$c->setHeight(3);
//не документирован, но тоже работает фильтр по объемному весу
$c->setVolumetricWeight(15);

//TypeOfPacking уже не используется в АПИ и не добавлен
$list = $c->getPackList();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getTypesOfPayersForRedelivery()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1) справочника видов плательщиков обратной доставки

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getTypesOfPayersForRedelivery();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getTypesOfPayers()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1) справочника видов плательщиков доставки

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getTypesOfPayers();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getPalletsList()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5dd575e-8512-11ec-8ced-005056b2dbe1) справочника видов паллет

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getPalletsList();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getBackwardDeliveryCargoTypes()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5b46873-8512-11ec-8ced-005056b2dbe1) справочника видов обратной доставки груза

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getBackwardDeliveryCargoTypes();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getCargoTypes()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5912a1e-8512-11ec-8ced-005056b2dbe1) справочника видов груза

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getCargoTypes();

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


#### `getTimeIntervals()`
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a56d5c1c-8512-11ec-8ced-005056b2dbe1) справочника видов временных интервалов

```php
$c = new Common;
//не поддерживается лимит, пагинация и локализация
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626');
//либо
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626', Carbon::tomorrow()->format('d.m.Y'));

dd($list);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)


#### `getPersonalManager()`
Получение данных о персональном менеджере

```php
$c = new Common;
$c->setApi('...');

$data = $c->getPersonalManager('00000000-0000-0000-0000-000000000000');

dd($data);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
