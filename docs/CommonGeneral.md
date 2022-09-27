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
[Получение](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1) справочника перечня ошибок

```php
$cg = new CommonGeneral;
$lg = $cg->getMessageCodeText();

dd($lg);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `prolongateKey()`
Данная ф-ция НЕ РАБОТАЕТ, потому как требует авторизацию JWT.
Возможно в будущем она будет доступна и через API

```php
$cg = new CommonGeneral;
$api = $cg->prolongateKey('c9b*****ffd', 3);

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
