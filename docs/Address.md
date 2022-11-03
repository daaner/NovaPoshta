# Address
```php
use Daaner\NovaPoshta\Models\Address;
```

## Содержание
- [x] [Получение списка областей](Address.md#getAreas)
- [x] [Справочник городов компании](Address.md#getCities)
- [x] [Справочник отделений](Address.md#getWarehouses)
- [x] [Справочник типов отделений](Address.md#getWarehouseTypes)
- [x] [Получения отделений в конкретном городе/нас. пункте или поселке](Address.md#getWarehouseSettlements)
- [x] [Онлайн поиск в справочнике населенных пунктов](Address.md#searchSettlements)
- [x] [Онлайн поиск улиц в справочнике населенных пунктов](Address.md#searchSettlementStreets)
- [x] [Справочник улиц компании](Address.md#getStreet)
- [x] [Справочник населенных пунктов Украины](Address.md#getSettlements)


## Все методы модели
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
[Получение](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a20ee6e4-8512-11ec-8ced-005056b2dbe1) списка областей

```php
$adr = new Address;
$area = $adr->getAreas();

dd($area);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCities()`
[Получение](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1e6f0a7-8512-11ec-8ced-005056b2dbe1) списка городов

```php
//получить все города используя пагинацию
$adr = new Address;
$adr->setLimit(100);
$adr->setPage(3);
$cities = $adr->getCities();

dd($cities);

//Можно искать по имени. Опять же можно использовать пагинацию, но списки не большие, поэтому можно и без нее
$adr = new Address;
$cities = $adr->getCities('Днепр');

dd($cities);

//Можно получить данные по реф коду, указав вторым параметром `false`
$adr = new Address;
$city = $adr->getCities('ed5ca607-b33f-11e3-9fa0-0050568002cf', false);

dd($city);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getWarehouses()`
[Получение](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2322f38-8512-11ec-8ced-005056b2dbe1) списка отделений и почтоматов в городах

```php
$adr = new Address;

//необязательные фильтры применяются
$adr->filterBicycleParking();
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');
$adr->setLimit(8);

//получить все (используйте лимит и пагинацию, данных много)
$warehouses = $adr->getWarehouses();
//или
$warehouses = $adr->getWarehouses('Тернополь');
//или по "CityRef"
$warehouses = $adr->getWarehouses('db5c8904-391c-11dd-90d9-001a92567626', false);


dd($warehouses);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getWarehouseTypes()`
[Получение](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2587b53-8512-11ec-8ced-005056b2dbe1) типов отделений

```php
$adr = new Address;
$warehouseTypes = $adr->getWarehouseTypes();

dd($warehouseTypes);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getWarehouseSettlements()`
Получение списка отделений в населенном пункте

```php
$adr = new Address;

//необязательные фильтры
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');

$warehouses = $adr->getWarehouseSettlements('e71fe717-4b33-11e4-ab6d-005056801329');

dd($warehouses);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `searchSettlements()`
[Поиск](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a0eb83ab-8512-11ec-8ced-005056b2dbe1) населенных пунктов из справочника Settlements

```php
$adr = new Address;
//работает ф-ция лимита, но можно и без нее, setPage - НЕ применяется
$adr->setLimit(20);

$settlements = $adr->searchSettlements('Дне');

dd($settlements);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `searchSettlementStreets()`
[Поиск](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1329635-8512-11ec-8ced-005056b2dbe1) улиц в населенных пунктах

```php
$adr = new Address;
//работает ф-ция лимита, но можно и без нее, setPage - НЕ применяется
$adr->setLimit(20);
$streets = $adr->searchSettlementStreets('e718a680-4b33-11e4-ab6d-005056801329', 'Шевченк');

dd($streets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getStreet()`
[Получение](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a27c20d7-8512-11ec-8ced-005056b2dbe1) улиц в городе по CityRef

```php
$adr = new Address;

$adr->setLimit(2);
$adr->setPage(1);

$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d');
//или
$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', 'ш');

dd($streets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getSettlements()`
[Справочник](https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1c42723-8512-11ec-8ced-005056b2dbe1) населенных пунктов Украины

```php
$adr = new Address;
//насильно работает ф-ция лимита в 150 (setLimit - НЕ применяется)

$adr->setPage(3);

// Можно использовать фильтры (не обязательные)
$adr->filterAreaRef('dcaadf02-4b33-11e4-ab6d-005056801329'); //по области
$adr->filterRegionRef('dcaadf02-4b33-11e4-ab6d-005056801329'); //по региону
$adr->filterWarehouse(); //по наличию отделений в населенном пункте
$adr->filterRef('e71abb60-4b33-11e4-ab6d-005056801329'); //по Ref населенного пункта

$settlements = $adr->getSettlements();
//или
$settlements = $adr->getSettlements('днепр');

dd($settlements);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
