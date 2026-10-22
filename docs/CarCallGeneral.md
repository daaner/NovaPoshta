# CarCallGeneral - Виклик авто

```php
use Daaner\NovaPoshta\Models\CarCallGeneral;
```

## Зміст
- [x] [Ордери для замовлення авто](CarCallGeneral.md#getOrdersList) (офіційно не задокументовано)


## Усі методи моделі
- [getOrdersList()](#getOrdersList)

---


### `getOrdersList()`
Отримання списку ордерів для замовлення авто.

```php
$np = new CarCallGeneral;
$np->setAPI('3e6****367****bdba****2d87****da');

$check = $np->getOrdersList();
// або коротка інформація
$check = $np->getOrdersList(false);

dd($check);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
