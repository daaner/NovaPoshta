# CommonGeneral - API Справочники

```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```

## Содержание
- [x] [Перечень ошибок](CommonGeneral.md#getMessageCodeText)
- [x] [Продление API ключа](CommonGeneral.md#prolongateKey) - не работает


## Все методы модели
- [getMessageCodeText()](#getMessageCodeText)
- [prolongateKey($ApiKey, $month = 12)](#prolongateKey)


---

### `getMessageCodeText()`
[Получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/58f0730deea270153c8be3cd) справочника перечня ошибок
```php
$cg = new CommonGeneral;
$lg = $cg->getMessageCodeText();

dd($lg);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `prolongateKey()`
__НЕ ДОКУМЕНТИРОВАНО В ОФИЦИАЛЬНОЙ ДОКУМЕНТАЦИИ__

Данная ф-ция НЕ РАБОТАЕТ, потому как требует авторизацию JWT.
Возможно в будущем она будет доступна и через API

```php
$cg = new CommonGeneral;
$api = $cg->prolongateKey('c9b*****ffd', 3);

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
