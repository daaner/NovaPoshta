# LoyaltyUser

```php
use Daaner\NovaPoshta\Models\LoyaltyUser;
```

## Зміст
- [x] [Дані по бонусній картці](LoyaltyUser.md#getLoyaltyInfoByApiKey) (не задокументовано)
- [x] [Дані по нарахуванню бонусів](LoyaltyUser.md#getLoyaltyCardTurnoverByApiKey) (не задокументовано)
- [x] [Дані по промокодах](LoyaltyUser.md#getPromocodeByPhone) (не задокументовано)
- [x] [Дані по бонусній програмі](LoyaltyUser.md#getStandartCardsList) (не задокументовано)


## Усі методи моделі
- [getLoyaltyInfoByApiKey()](#getLoyaltyInfoByApiKey)
- [getLoyaltyCardTurnoverByApiKey($Year = null, $Month = null)](#getLoyaltyCardTurnoverByApiKey)
- [getPromocodeByPhone($Phone)](#getPromocodeByPhone)
- [getStandartCardsList($CounterpartyRef)](#getStandartCardsList)

---


### `getLoyaltyInfoByApiKey()`
Повертає стан балансу, номер бонусної картки та інші дані користувача

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');
$loyalty = $np->getLoyaltyInfoByApiKey();

dd($loyalty);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getLoyaltyCardTurnoverByApiKey()`
Отримання даних про нарахування та списання бонусів. Можна вказати рік і місяць.

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

// Без зазначення року й місяця виведе дані за поточний місяць
$loyalty = $np->getLoyaltyCardTurnoverByApiKey();

// Із зазначенням року й місяця
// Якщо вказати рік, а місяць пропустити - відображає останній (або поточний) місяць року
$loyalty = $np->getLoyaltyCardTurnoverByApiKey(2022, 11);

dd($loyalty);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getPromocodeByPhone()`
Отримання активних промокодів, прив'язаних до телефону контрагента.

__ Метод працює лише для PrivatePerson __

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

// Телефон контрагента у форматі +38067..., 38067... або 067...
$loyalty = $np->getPromocodeByPhone('+380671112233');

dd($loyalty);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getStandartCardsList()`
Список даних по бонусній програмі контрагента.

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

//НЕОБОВ'ЯЗКОВІ параметри
$np->setLimit(10);
$np->setPage(2);

$CounterpartyRef = '00000000-0000-0000-0000-000000000000';
$loyalty = $np->getStandartCardsList($CounterpartyRef);

dd($loyalty);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
