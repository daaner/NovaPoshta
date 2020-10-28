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
- [getCities($find = null, $string = true)](#getCities)
- [getWarehouses($cityRef = null, $string = true)](#getWarehouses)
- [getWarehouseTypes($cityName)](#getWarehouseTypes)
- [getWarehouseSettlements($settlementRef)](#getWarehouseSettlements)
- [searchSettlements($search)](#searchSettlements)
- [searchSettlementStreets($ref, $street)](#searchSettlementStreets)
- [getStreet($city, $find = null)](#getStreet)
- [getSettlements($find = null)](#getSettlements)



---

### `getAreas()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d9130a0fe4f08e8f7ce48) списка областей
```php
$adr = new Address;
$area = $adr->getAreas();

dd($area);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCities()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d885da0fe4f08e8f7ce46) списка городов
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
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45) списка отделений в городах
```php
$adr = new Address;
//получить все (используйте лимит и пагинацию, данных много)
$warehouses = $adr->getWarehouses();
//или
$warehouses = $adr->getWarehouses('Киев');
//или по "CityRef"
$warehouses = $adr->getWarehouses('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', false);

//необязательные фильтры применяются
$adr->filterBicycleParking();
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');

dd($warehouses);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getWarehouseTypes()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45) типов отделений в населенном пункте
```php
$adr = new Address;
$warehouseTypes = $adr->getWarehouseTypes('Киев');
//или по "CityRef"
$warehouseTypes = $adr->getWarehouseTypes('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', false);

dd($warehouseTypes);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getWarehouseSettlements()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45) списка отделений в населенном пункте
```php
$adr = new Address;
$warehouses = $adr->getWarehouseSettlements('e71405ee-4b33-11e4-ab6d-005056801329');

//необязательные фильтры применяются
$adr->filterBicycleParking();
$adr->filterPostFinance();
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');
$adr->setTypeOfWarehouseRef('9a68df70-0267-42a8-bb5c-37f427e36ee4');

dd($warehouses);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `searchSettlements()`
[Поиск](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5ebeceea27017bc851d67) населенных пунктов из справочника Settlements
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
[Поиск](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5f369eea27017540b58ac) улиц в населенных пунктах
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
[Получение](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8db0a0fe4f08e8f7ce47) улиц в городе по CityRef
```php
$adr = new Address;
//работает ф-ция лимита и страниц, но можно и без них
$adr->setLimit(4);
$adr->setPage(3);

$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d');
//или
$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', 'ш');

dd($streets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getSettlements()`
[Справочник](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/56248fffa0fe4f0da0550ea8) населенных пунктов Украины
```php
$adr = new Address;
//работает ф-ция лимита и страниц, но можно и без них
//однако, наблюдается баг. При использовании лимита, общее кол-во записей приравневается ему
//для получения правильного общего числа записей используйте значение 150 (по умолчанию)
//значение более 300 - вызывает 500 ошибку при запросе на сервер Новой Почты
$adr->setLimit(5);
$adr->setPage(3);

//фильтрации (не обязательные)
$adr->filterAreaRef('dcaae4e5-4b33-11e4-ab6d-005056801329');
$adr->filterRegionRef('e4ade6ea-4b33-11e4-ab6d-005056801329');
$adr->filterRef('0e451e40-4b3a-11e4-ab6d-005056801329');
$adr->filterWarehouse();

$settlements = $adr->getSettlements();
//или
$settlements = $adr->getSettlements('бров');


dd($settlements);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
