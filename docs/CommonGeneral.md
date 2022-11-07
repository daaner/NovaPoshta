# CommonGeneral - API Справочники

```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```

## Содержание
- [x] [Перечень ошибок](CommonGeneral.md#getMessageCodeText)
- [x] [Продление API ключа](CommonGeneral.md#prolongateKey)
- [x] [Получение списка API ключей](CommonGeneral.md#getApiKeysList)
- [x] [Создать API ключ](CommonGeneral.md#createApiKey)
- [x] [Удалить API ключ](CommonGeneral.md#deleteApiKey)
- [x] [Получение списка доверенных устройств](CommonGeneral.md#getTrustedDevicesList)
- [x] [Удаление доверенного устройства из списка](CommonGeneral.md#deleteTrustedDevice)


## Все методы модели
- [getMessageCodeText()](#getMessageCodeText)
- [prolongateKey($ApiKey, $month = 12)](#prolongateKey)
- [getApiKeysList()](#getApiKeysList)
- [createApiKey($MarketplacePartnerToken = null)](#createApiKey)
- [deleteApiKey($ApiKey)](#deleteApiKey)
- [getTrustedDevicesList()](#getTrustedDevicesList)
- [deleteTrustedDevice($Ref)](#deleteTrustedDevice)


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
Продление действия API ключа.

```php
$cg = new CommonGeneral;
$api = '3e6****367****bdba****2d87****da';
$cg->setAPI($api);
$api = $cg->prolongateKey($api, 3);

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getApiKeysList()`
Получение списка доступных API ключей

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->getApiKeysList();

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `createApiKey()`
Создание API ключа

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->createApiKey();

//Для персонализации ключа, если у вас имеется Ref организации, можете его указать 
$api = $cg->createApiKey('005056887b8d-8478-11e5-c9ad-fa7dc024');

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `deleteApiKey()`
Удаление (отключение активности) API ключа

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$ApiKey = '00000000001111111111222222222233';
$api = $cg->deleteApiKey($ApiKey);

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getTrustedDevicesList()`
Получение списка доверенных устройств

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$api = $cg->getTrustedDevicesList();

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `deleteTrustedDevice()`
Удаление доверенного устройства из списка

```php
$cg = new CommonGeneral;
$cg->setAPI('3e6****367****bdba****2d87****da');
$Ref = '12345sfdfsd';
$api = $cg->deleteTrustedDevice($Ref);

dd($api);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
