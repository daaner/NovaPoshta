# Payment - Платежные данные

```php
use Daaner\NovaPoshta\Models\Payment;
```

## Содержание
- [x] [Получение данных по картам оплаты](Payment.md#walletManagement) (официально не документировано)


## Все методы модели
- [walletManagement()](#walletManagement)

---


### `walletManagement()`
Получение данных по картам оплаты, подключенным к системе

```php
$np = new Payment;
$np->setAPI('3e6****367****bdba****2d87****da');
$check = $np->walletManagement();

dd($check);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
