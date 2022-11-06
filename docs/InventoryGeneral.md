# InventoryGeneral - Материальные ценности

```php
use Daaner\NovaPoshta\Models\InventoryGeneral;
```

## Содержание
- [x] [Список доступных материальных ценностей](InventoryGeneral.md#getInventoryNomenclaturesList) (официально не документировано)
- [x] [Список заказов](InventoryGeneral.md#getInventoryOrdersList) (официально не документировано)


## Все методы модели
- [getInventoryNomenclaturesList()](#getInventoryNomenclaturesList)
- [getInventoryOrdersList($Ref = null)](#getInventoryOrdersList)

---


### `getInventoryNomenclaturesList()`
Получение списка доступных к заказу материальных ценностей.

```php
$np = new InventoryGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');
$check = $np->getInventoryNomenclaturesList();

dd($check);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getInventoryOrdersList()`
Получение списка заказанных материальных ценностей.

```php
$np = new InventoryGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');

//НЕОБЯЗАТЕЛЬНЫЕ параметры
$np->setLimit(10);
$np->setPage(2);

$check = $np->getInventoryOrdersList();

//либо
$check = $np->getInventoryOrdersList('ref контрагента');


dd($check);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
