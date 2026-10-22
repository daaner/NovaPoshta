# Payment - Платіжні дані

```php
use Daaner\NovaPoshta\Models\Payment;
```

## Зміст
- [x] [Отримання даних по картках оплати](Payment.md#walletManagement) (офіційно не задокументовано)


## Усі методи моделі
- [walletManagement()](#walletManagement)

---


### `walletManagement()`
Отримання даних по картках оплати, підключених до системи

```php
$np = new Payment;
$np->setAPI('3e6****367****bdba****2d87****da');
$check = $np->walletManagement();

dd($check);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
