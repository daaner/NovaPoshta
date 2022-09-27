# LoyaltyUser

```php
use Daaner\NovaPoshta\Models\LoyaltyUser;
```

## Содержание
- [x] [Получение данных по бонусной карте](LoyaltyUser.md#getLoyaltyInfoByApiKey) (официально не документировано)


## Все методы модели
- [getLoyaltyInfoByApiKey()](#getLoyaltyInfoByApiKey)

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
