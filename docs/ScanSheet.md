# InternetDocument

```php
use Daaner\NovaPoshta\Models\ScanSheet;
```

## Содержание
- [x] [Загрузить список реестров](ScanSheet.md#getScanSheetList)
- [x] [Загрузить информацию по одному реестру](ScanSheet.md#getScanSheet)


## Все методы модели
- [getScanSheetList()](#getScanSheetList)
- [getScanSheet()](#getScanSheet)

---


### `getScanSheetList()`
[Загрузить](https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c7734a0fe4f08e8f7ce31) список реестров (требует ключ API)
```php

$np = new ScanSheet;
$scansheets = $np->getScanSheetList();

dd($scansheets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getScanSheet()`
[Загрузить](https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c7734a0fe4f08e8f7ce31) информацию по одному реестру (требует ключ API)
```php

$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->getScanSheet($ref);

dd($scansheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
