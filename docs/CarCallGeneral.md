# CarCallGeneral - Материальные ценности

```php
use Daaner\NovaPoshta\Models\CarCallGeneral;
```

## Содержание
- [x] [Ордера для заказа авто](CarCallGeneral.md#getOrdersList) (официально не документировано)


## Все методы модели
- [getOrdersList()](#getOrdersList)

---


### `getOrdersList()`
Получение списка ордеров для заказа авто.

```php
$np = new CarCallGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');

$check = $np->getOrdersList();
// либо короткая информация
$check = $np->getOrdersList(false);

dd($check);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***

