# Address
```php
use Daaner\NovaPoshta\Models\Address;
```

## Зміст
- [x] [Отримання списку областей](Address.md#getAreas)
- [x] [Довідник міст компанії](Address.md#getCities)
- [x] [Довідник відділень](Address.md#getWarehouses)
- [x] [Довідник типів відділень](Address.md#getWarehouseTypes)
- [x] [Отримання відділень у конкретному місті/нас. пункті або селищі](Address.md#getWarehouseSettlements)
- [x] [Онлайн пошук у довіднику населених пунктів](Address.md#searchSettlements)
- [x] [Онлайн пошук вулиць у довіднику населених пунктів](Address.md#searchSettlementStreets)
- [x] [Довідник вулиць компанії](Address.md#getStreet)
- [x] [Довідник населених пунктів України](Address.md#getSettlements)


## Усі методи моделі
- [getAreas()](#getAreas)
- [getCities($find = null, $searchByString = true)](#getCities)
- [getWarehouses($cityRef = null, $searchByString = true)](#getWarehouses)
- [getWarehouseTypes($cityName)](#getWarehouseTypes)
- [getWarehouseSettlements($settlementRef)](#getWarehouseSettlements)
- [searchSettlements($search)](#searchSettlements)
- [searchSettlementStreets($ref, $street)](#searchSettlementStreets)
- [getStreet($city, $find = null)](#getStreet)
- [getSettlements($find = null)](#getSettlements)



---

### `getAreas()`
[Отримання](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a20ee6e4-8512-11ec-8ced-005056b2dbe1) списку областей

```php
$adr = new Address;
$area = $adr->getAreas();

dd($area);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getCities()`
[Отримання](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1e6f0a7-8512-11ec-8ced-005056b2dbe1) списку міст

```php
//отримати всі міста з пагінацією
$adr = new Address;
$adr->setLimit(100);
$adr->setPage(3);
$cities = $adr->getCities();

dd($cities);

//Можна шукати за назвою. Пагінацію теж можна використовувати, але списки невеликі, тож можна і без неї
$adr = new Address;
$cities = $adr->getCities('Дніпро');

dd($cities);

//Можна отримати дані за реф-кодом, вказавши другим параметром `false`
$adr = new Address;
$city = $adr->getCities('ed5ca607-b33f-11e3-9fa0-0050568002cf', false);

dd($city);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getWarehouses()`
[Отримання](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2322f38-8512-11ec-8ced-005056b2dbe1) списку відділень і поштоматів у містах

```php
$adr = new Address;

//необов'язкові фільтри
$adr->filterBicycleParking();
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');
$adr->setLimit(8);

//отримати всі (використовуйте ліміт і пагінацію, даних багато)
$warehouses = $adr->getWarehouses();
//або
$warehouses = $adr->getWarehouses('Тернопіль');
//або за "CityRef"
$warehouses = $adr->getWarehouses('db5c8904-391c-11dd-90d9-001a92567626', false);


dd($warehouses);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getWarehouseTypes()`
[Отримання](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2587b53-8512-11ec-8ced-005056b2dbe1) типів відділень

```php
$adr = new Address;
$warehouseTypes = $adr->getWarehouseTypes();

dd($warehouseTypes);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getWarehouseSettlements()`
Отримання списку відділень у населеному пункті

```php
$adr = new Address;

//необов'язкові фільтри
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');

$warehouses = $adr->getWarehouseSettlements('e71fe717-4b33-11e4-ab6d-005056801329');

dd($warehouses);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `searchSettlements()`
[Пошук](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a0eb83ab-8512-11ec-8ced-005056b2dbe1) населених пунктів у довіднику Settlements

```php
$adr = new Address;
//працює функція ліміту, але можна і без неї, setPage - НЕ застосовується
$adr->setLimit(20);

$settlements = $adr->searchSettlements('Дні');

dd($settlements);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `searchSettlementStreets()`
[Пошук](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1329635-8512-11ec-8ced-005056b2dbe1) вулиць у населених пунктах

```php
$adr = new Address;
//працює функція ліміту, але можна і без неї, setPage - НЕ застосовується
$adr->setLimit(20);
$streets = $adr->searchSettlementStreets('e718a680-4b33-11e4-ab6d-005056801329', 'Шевченк');

dd($streets);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getStreet()`
[Отримання](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a27c20d7-8512-11ec-8ced-005056b2dbe1) вулиць у місті за CityRef

```php
$adr = new Address;

$adr->setLimit(2);
$adr->setPage(1);

$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d');
//або
$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', 'ш');

dd($streets);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getSettlements()`
[Довідник](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1c42723-8512-11ec-8ced-005056b2dbe1) населених пунктів України

```php
$adr = new Address;
//примусово працює ліміт у 150 (setLimit - НЕ застосовується)

$adr->setPage(3);

// Можна використовувати фільтри (не обов'язкові)
$adr->filterAreaRef('dcaadf02-4b33-11e4-ab6d-005056801329'); //за областю
$adr->filterRegionRef('dcaadf02-4b33-11e4-ab6d-005056801329'); //за регіоном
$adr->filterWarehouse(); //за наявністю відділень у населеному пункті
$adr->filterRef('e71abb60-4b33-11e4-ab6d-005056801329'); //за Ref населеного пункту

$settlements = $adr->getSettlements();
//або
$settlements = $adr->getSettlements('дніпро');

dd($settlements);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
