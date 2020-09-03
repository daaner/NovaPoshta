# ScanSheet

```php
use Daaner\NovaPoshta\Models\ScanSheet;
```

## Содержание
- [x] [Загрузить список реестров](ScanSheet.md#getScanSheetList)
- [x] [Загрузить информацию по одному реестру](ScanSheet.md#getScanSheet)
- [x] [Удалить экспресс-накладные из реестра](ScanSheet.md#removeDocuments)
- [x] [Обновить описание реестра](ScanSheet.md#updateScanSheet) (официально не документировано)
- [x] [Краткий список накладных реестра](ScanSheet.md#getScanSheetDocuments) (официально не документировано)


## Все методы модели
- [getScanSheetList()](#getScanSheetList)
- [getScanSheet()](#getScanSheet)
- [removeDocuments()](#removeDocuments)
- [updateScanSheet()](#updateScanSheet)
- [getScanSheetDocuments()](#getScanSheetDocuments)

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


### `removeDocuments()`
[Удалить](https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6474a0fe4f08e8f7ce2e) экспресс-накладные из реестра (требует ключ API)
```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5'; //не обязательно

// значение $documents может быть string или array
$documents = 'd7fb***2-e**b-1**a-8**3-b8830***9df5';
// либо
$documents = [
  'd7fb***2-e**b-1**a-8**3-b8830***9df5',
  'd7fb***2-e**b-1**a-8**3-b8830***9df6',
  'd7fb***2-e**b-1**a-8**3-b8830***9df7'
];

$scansheet = $np->removeDocuments($documents, $ref);

dd($scansheet);
```
`$ref` реестра можно не указывать, удаление все равно происходит, даже если значение не соответствует текущему реестру накладной

[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `updateScanSheet()`
__НЕ ДОКУМЕНТИРОВАНО В ОФИЦИАЛЬНОЙ ДОКУМЕНТАЦИИ__
Обновить описание реестра (максимум 101 символ с пробелами без специальных знаков) (требует ключ API)
```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->updateScanSheet($ref, 'Новое описание реестра');

dd($scansheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getScanSheetDocuments()`
__НЕ ДОКУМЕНТИРОВАНО В ОФИЦИАЛЬНОЙ ДОКУМЕНТАЦИИ__
Получить краткий список ТТН реестра (требует ключ API)
```php
$np = new ScanSheet;
$np->setLimit(5); // НЕ обязательно
$np->setPage(2);  // НЕ обязательно

$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->getScanSheetDocuments($ref);

dd($scansheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
