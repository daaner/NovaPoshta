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
- [x] [Добавить экспресс-накладные в реестр](ScanSheet.md#insertDocuments)
- [x] [Удалить (расформировать) реестр отправлений](ScanSheet.md#deleteScanSheet)


## Все методы модели
- [getScanSheetList()](#getScanSheetList)
- [getScanSheet()](#getScanSheet)
- [removeDocuments()](#removeDocuments)
- [updateScanSheet()](#updateScanSheet)
- [getScanSheetDocuments()](#getScanSheetDocuments)
- [insertDocuments($DocumentRefs, $Ref = null, $Date = null)](#insertDocuments)
- [deleteScanSheet($ScanSheetRefs)](#deleteScanSheet)

---


### `getScanSheetList()`
Загрузить список реестров (требует ключ API)

```php
$np = new ScanSheet;
$scansheets = $np->getScanSheetList();

dd($scansheets);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getScanSheet()`
Загрузить информацию по одному реестру (требует ключ API)

```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->getScanSheet($ref);

dd($scansheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `removeDocuments()`
Удалить экспресс-накладные из реестра (требует ключ API)

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


### `insertDocuments()`
Добавить экспресс-накладные в реестр (требует ключ API)

```php
$np = new ScanSheet;

$DocumentRefs = '3d***-1aa6-***-b8***f5';
// либо
$DocumentRefs = [
  15 => '3d***-1aa6-***-b8***f5',
  "100500" => '3d***-1baa6-***-b8***f5',
  '3d***-1ca6-***-b8***f5'
];

//не обязательно, но можно указать в какой реестр помещать
$Ref = 'Ref реестра';

//дата реестра больше текущей
$Date = '2020-10-30';

$addScanSheet = $np->insertDocuments($DocumentRefs, $Ref, $Date);
//либо
$addScanSheet = $np->insertDocuments($DocumentRefs);

dd($addScanSheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `deleteScanSheet()`
Удалить (расформировать) реестр отправлений (требует ключ API)

```php
$np = new ScanSheet;

$ScanSheetRefs = '3d***-1aa6-***-b8***f5';
// либо
$ScanSheetRefs = [
  15 => '3d***-1aa6-***-b8***f5',
  "100500" => '3d***-1baa6-***-b8***f5',
  '3d***-1ca6-***-b8***f5'
];

$deleteScanSheet = $np->deleteScanSheet($ScanSheetRefs);

dd($deleteScanSheet);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
