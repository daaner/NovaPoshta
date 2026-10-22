# InventoryGeneral - Матеріальні цінності

```php
use Daaner\NovaPoshta\Models\InventoryGeneral;
```

## Зміст
- [x] [Список доступних матеріальних цінностей](InventoryGeneral.md#getInventoryNomenclaturesList) (офіційно не задокументовано)
- [x] [Список замовлень](InventoryGeneral.md#getInventoryOrdersList) (офіційно не задокументовано)


## Усі методи моделі
- [getInventoryNomenclaturesList()](#getInventoryNomenclaturesList)
- [getInventoryOrdersList($Ref = null)](#getInventoryOrdersList)

---


### `getInventoryNomenclaturesList()`
Отримання списку матеріальних цінностей, доступних для замовлення.

```php
$np = new InventoryGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');
$check = $np->getInventoryNomenclaturesList();

dd($check);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getInventoryOrdersList()`
Отримання списку замовлених матеріальних цінностей.

```php
$np = new InventoryGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');

//НЕОБОВ'ЯЗКОВІ параметри
$np->setLimit(10);
$np->setPage(2);

$check = $np->getInventoryOrdersList();

//або
$check = $np->getInventoryOrdersList('ref контрагента');


dd($check);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
