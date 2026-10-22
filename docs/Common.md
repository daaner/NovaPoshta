# Common - API Довідники
```php
use Daaner\NovaPoshta\Models\Common;
```

## Зміст
- [x] [Види часових інтервалів](Common.md#getTimeIntervals)
- [x] [Види вантажу](Common.md#getCargoTypes)
- [x] [Види зворотної доставки вантажу](Common.md#getBackwardDeliveryCargoTypes)
- [x] [Види палет](Common.md#getPalletsList)
- [x] [Види платників](Common.md#getTypesOfPayers)
- [x] [Види платників зворотної доставки](Common.md#getTypesOfPayersForRedelivery)
- [x] [Види пакування](Common.md#getPackList)
- [x] [Види шин і дисків](Common.md#getTiresWheelsList)
- [x] [Описи вантажу](Common.md#getCargoDescriptionList)
- [x] [Перелік помилок](CommonGeneral.md#getMessageCodeText)
- [x] [Технології доставки](Common.md#getServiceTypes)
- [x] [Типи контрагентів](Common.md#getTypesOfCounterparties)
- [x] [Форми оплати](Common.md#getPaymentForms)
- [x] [Форми власності](Common.md#getOwnershipFormsList)
- [x] [Отримання даних про менеджера](Common.md#getPersonalManager)

## Усі методи моделі
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
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a754ff0d-8512-11ec-8ced-005056b2dbe1) довідника форм власності

```php
$c = new Common;
//локалізація довідника не підтримується Новою Поштою
$list = $c->getOwnershipFormsList();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getPaymentForms()`
Отримання довідника форм оплати

```php
$c = new Common;
//локалізація довідника не підтримується Новою Поштою
$list = $c->getPaymentForms();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getTypesOfCounterparties()`
Отримання довідника типів контрагентів

```php
$c = new Common;
//локалізація довідника не підтримується Новою Поштою
$list = $c->getTypesOfCounterparties();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getServiceTypes()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6e189f7-8512-11ec-8ced-005056b2dbe1) довідника технологій доставки

```php
$c = new Common;
//локалізація довідника не підтримується Новою Поштою
$list = $c->getServiceTypes();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getCargoDescriptionList()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a697db47-8512-11ec-8ced-005056b2dbe1) довідника описів вантажу

```php
$c = new Common;
//працює пагінація, але не підтримуються ліміт і локалізація
$c->setPage(2);
$list = $c->getCargoDescriptionList();

//можна шукати за українськими та російськими словами (регістр не важливий)
$list = $c->getCargoDescriptionList('Од');

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getTiresWheelsList()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a66fada0-8512-11ec-8ced-005056b2dbe1) довідника видів шин і дисків

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getTiresWheelsList();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getPackList()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6492db4-8512-11ec-8ced-005056b2dbe1) довідника видів пакування

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація

//працюють необов'язкові фільтри, вибирається значення, більше або рівне вказаному
$c->setLength(3); // або $c->setLength('12.0');
$c->setWidth(3);
$c->setHeight(3);
//не задокументований, але теж працює фільтр за об'ємною вагою
$c->setVolumetricWeight(15);

//TypeOfPacking вже не використовується в API і не доданий
$list = $c->getPackList();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getTypesOfPayersForRedelivery()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1) довідника видів платників зворотної доставки

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getTypesOfPayersForRedelivery();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getTypesOfPayers()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1) довідника видів платників доставки

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getTypesOfPayers();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getPalletsList()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5dd575e-8512-11ec-8ced-005056b2dbe1) довідника видів палет

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getPalletsList();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getBackwardDeliveryCargoTypes()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5b46873-8512-11ec-8ced-005056b2dbe1) довідника видів зворотної доставки вантажу

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getBackwardDeliveryCargoTypes();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getCargoTypes()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5912a1e-8512-11ec-8ced-005056b2dbe1) довідника видів вантажу

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getCargoTypes();

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


#### `getTimeIntervals()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a56d5c1c-8512-11ec-8ced-005056b2dbe1) довідника видів часових інтервалів

```php
$c = new Common;
//не підтримуються ліміт, пагінація та локалізація
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626');
//або
$list = $c->getTimeIntervals('8d5a980d-391c-11dd-90d9-001a92567626', Carbon::tomorrow()->format('d.m.Y'));

dd($list);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)


#### `getPersonalManager()`
Отримання даних про персонального менеджера

```php
$c = new Common;
$c->setApi('...');

$data = $c->getPersonalManager('00000000-0000-0000-0000-000000000000');

dd($data);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
