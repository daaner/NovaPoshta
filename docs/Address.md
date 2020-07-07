# Address
```php
use Daaner\NovaPoshta\Models\Address;
```

## Содержание


## Все методы модели
- [getAreas()](#getAreas)
- [getCities()](#getCities)
- [getWarehouses($cityName, $notSearchInRef = true)](#getWarehouses)
- [getWarehouseSettlements($settlementRef)](#getWarehouseSettlements)
- [getWarehouseTypes($cityName)](#getWarehouseTypes)
- [searchSettlements($search)](#searchSettlements)
- [searchSettlementStreets($ref, $street)](#searchSettlementStreets)
- [getStreet($city, $find = null)](#getStreet)


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
[Поиск](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8db0a0fe4f08e8f7ce47) улиц в в городе по CityRef
```php
$adr = new Address;
$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d');
//или
$streets = $adr->getStreet('a9522a7e-eaf5-11e7-ba66-005056b2fc3d', 'Абри');

//работает ф-ция лимита и страниц, но можно и без них
$this->addLimit();
$this->getPage();

dd($streets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
