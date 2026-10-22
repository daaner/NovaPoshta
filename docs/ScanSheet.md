# ScanSheet

```php
use Daaner\NovaPoshta\Models\ScanSheet;
```

## Зміст
- [x] [Завантажити список реєстрів](ScanSheet.md#getScanSheetList)
- [x] [Завантажити інформацію по одному реєстру](ScanSheet.md#getScanSheet)
- [x] [Видалити експрес-накладні з реєстру](ScanSheet.md#removeDocuments)
- [x] [Оновити опис реєстру](ScanSheet.md#updateScanSheet) (офіційно не задокументовано)
- [x] [Короткий список накладних реєстру](ScanSheet.md#getScanSheetDocuments) (офіційно не задокументовано)
- [x] [Додати експрес-накладні до реєстру](ScanSheet.md#insertDocuments)
- [x] [Видалити (розформувати) реєстр відправлень](ScanSheet.md#deleteScanSheet)


## Усі методи моделі
- [getScanSheetList()](#getScanSheetList)
- [getScanSheet()](#getScanSheet)
- [removeDocuments()](#removeDocuments)
- [updateScanSheet()](#updateScanSheet)
- [getScanSheetDocuments()](#getScanSheetDocuments)
- [insertDocuments($DocumentRefs, $Ref = null, $Date = null)](#insertDocuments)
- [deleteScanSheet($ScanSheetRefs)](#deleteScanSheet)

---


### `getScanSheetList()`
Завантажити список реєстрів (потрібен ключ API)

```php
$np = new ScanSheet;
$scansheets = $np->getScanSheetList();

dd($scansheets);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getScanSheet()`
Завантажити інформацію по одному реєстру (потрібен ключ API)

```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->getScanSheet($ref);

dd($scansheet);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `removeDocuments()`
Видалити експрес-накладні з реєстру (потрібен ключ API)

```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5'; //не обов'язково

// значення $documents може бути string або array
$documents = 'd7fb***2-e**b-1**a-8**3-b8830***9df5';
// або
$documents = [
  'd7fb***2-e**b-1**a-8**3-b8830***9df5',
  'd7fb***2-e**b-1**a-8**3-b8830***9df6',
  'd7fb***2-e**b-1**a-8**3-b8830***9df7'
];

$scansheet = $np->removeDocuments($documents, $ref);

dd($scansheet);
```
`$ref` реєстру можна не вказувати, видалення все одно відбувається, навіть якщо значення не відповідає поточному реєстру накладної

[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `updateScanSheet()`
Оновити опис реєстру (максимум 101 символ з пробілами, без спеціальних знаків) (потрібен ключ API)

```php
$np = new ScanSheet;
$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->updateScanSheet($ref, 'Новий опис реєстру');

dd($scansheet);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getScanSheetDocuments()`
Отримати короткий список ТТН реєстру (потрібен ключ API)

```php
$np = new ScanSheet;
$np->setLimit(5); // Не обов'язково
$np->setPage(2);  // Не обов'язково

$ref = 'd1****54-****-****-****-b8830****df5';
$scansheet = $np->getScanSheetDocuments($ref);

dd($scansheet);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `insertDocuments()`
Додати експрес-накладні до реєстру (потрібен ключ API)

```php
$np = new ScanSheet;

$DocumentRefs = '3d***-1aa6-***-b8***f5';
// або
$DocumentRefs = [
  15 => '3d***-1aa6-***-b8***f5',
  "100500" => '3d***-1baa6-***-b8***f5',
  '3d***-1ca6-***-b8***f5'
];

//не обов'язково, але можна вказати, до якого реєстру додавати
$Ref = 'Ref реєстру';

//дата реєстру, більша за поточну
$Date = '2020-10-30';

$addScanSheet = $np->insertDocuments($DocumentRefs, $Ref, $Date);
//або
$addScanSheet = $np->insertDocuments($DocumentRefs);

dd($addScanSheet);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `deleteScanSheet()`
Видалити (розформувати) реєстр відправлень (потрібен ключ API)

```php
$np = new ScanSheet;

$ScanSheetRefs = '3d***-1aa6-***-b8***f5';
// або
$ScanSheetRefs = [
  15 => '3d***-1aa6-***-b8***f5',
  "100500" => '3d***-1baa6-***-b8***f5',
  '3d***-1ca6-***-b8***f5'
];

$deleteScanSheet = $np->deleteScanSheet($ScanSheetRefs);

dd($deleteScanSheet);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
