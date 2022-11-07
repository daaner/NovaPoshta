# LoyaltyUser

```php
use Daaner\NovaPoshta\Models\LoyaltyUser;
```

## Содержание
- [x] [Данные по бонусной карте](LoyaltyUser.md#getLoyaltyInfoByApiKey) (не документировано)
- [x] [Данные по начислению бонусов](LoyaltyUser.md#getLoyaltyCardTurnoverByApiKey) (не документировано)
- [x] [Данные по промокодам](LoyaltyUser.md#getPromocodeByPhone) (не документировано)
- [x] [Данные по бонусной программе](LoyaltyUser.md#getStandartCardsList) (не документировано)


## Все методы модели
- [getLoyaltyInfoByApiKey()](#getLoyaltyInfoByApiKey)
- [getLoyaltyCardTurnoverByApiKey($Year = null, $Month = null)](#getLoyaltyCardTurnoverByApiKey)
- [getPromocodeByPhone($Phone)](#getPromocodeByPhone)
- [getStandartCardsList($CounterpartyRef)](#getStandartCardsList)

---


### `getLoyaltyInfoByApiKey()`
Возвращает статус баланса, номер бонусной карты и остальные данные по пользователю

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');
$loyalty = $np->getLoyaltyInfoByApiKey();

dd($loyalty);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getLoyaltyCardTurnoverByApiKey()`
Получение данных о начислении и списании бонусов. Можно указать год и месяц.

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

// Без указания года и месяца выведет данные о текущем месяце
$loyalty = $np->getLoyaltyCardTurnoverByApiKey();

// С указанием года и месяца
// Если указать год, а месяц опустить - отображает последний (либо текущий) месяц года
$loyalty = $np->getLoyaltyCardTurnoverByApiKey(2022, 11);

dd($loyalty);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getPromocodeByPhone()`
Получение активных промокодов прикрепленных к телефону контрагента.

__ Метод работает только для PrivatePerson __

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

// Телефон контрагента в формате +38067..., 38067... либо 067...
$loyalty = $np->getPromocodeByPhone('+380671112233');

dd($loyalty);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getStandartCardsList()`
Список данных по бонусной программе контрагента.

```php
$np = new LoyaltyUser;
$np->setAPI('3e6****367****bdba****2d87****da');

//НЕОБЯЗАТЕЛЬНЫЕ параметры
$np->setLimit(10);
$np->setPage(2);

$CounterpartyRef = '00000000-0000-0000-0000-000000000000';
$loyalty = $np->getStandartCardsList($CounterpartyRef);

dd($loyalty);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
