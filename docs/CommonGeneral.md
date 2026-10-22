# CommonGeneral - API Довідники

```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```

## Зміст
- [x] [Перелік помилок](CommonGeneral.md#getMessageCodeText)
- [x] [Продовження API ключа](CommonGeneral.md#prolongateKey)
- [x] [Отримання списку API ключів](CommonGeneral.md#getApiKeysList)
- [x] [Створити API ключ](CommonGeneral.md#createApiKey)
- [x] [Видалити API ключ](CommonGeneral.md#deleteApiKey)
- [x] [Отримання списку довірених пристроїв](CommonGeneral.md#getTrustedDevicesList)
- [x] [Видалення довіреного пристрою зі списку](CommonGeneral.md#deleteTrustedDevice)


## Усі методи моделі
- [getMessageCodeText()](#getMessageCodeText)
- [prolongateKey($ApiKey, $month = 12)](#prolongateKey)
- [getApiKeysList()](#getApiKeysList)
- [createApiKey($MarketplacePartnerToken = null)](#createApiKey)
- [deleteApiKey($ApiKey)](#deleteApiKey)
- [getTrustedDevicesList()](#getTrustedDevicesList)
- [deleteTrustedDevice($Ref)](#deleteTrustedDevice)


---

### `getMessageCodeText()`
[Отримання](https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1) довідника переліку помилок

```php
$cg = new CommonGeneral;
$lg = $cg->getMessageCodeText();

dd($lg);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `prolongateKey()`
Продовження дії API ключа.

```php
$cg = new CommonGeneral;
$api = '3e6****367****bdba****2d87****da';
$cg->setAPI($api);
$api = $cg->prolongateKey($api, 3);

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getApiKeysList()`
Отримання списку доступних API ключів

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->getApiKeysList();

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `createApiKey()`
Створення API ключа

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->createApiKey();

//Для персоналізації ключа, якщо у вас є Ref організації, можете його вказати
$api = $cg->createApiKey('005056887b8d-8478-11e5-c9ad-fa7dc024');

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `deleteApiKey()`
Видалення (вимкнення активності) API ключа

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$ApiKey = '00000000001111111111222222222233';
$api = $cg->deleteApiKey($ApiKey);

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getTrustedDevicesList()`
Отримання списку довірених пристроїв

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->getTrustedDevicesList();

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `deleteTrustedDevice()`
Видалення довіреного пристрою зі списку

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$Ref = '12345sfdfsd';
$api = $cg->deleteTrustedDevice($Ref);

dd($api);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
