# Changelog

All notable changes to `NovaPoshta` will be documented in this file

### 2022-10-14
- [Add] Добавление метода `delete` в `AdditionalService`

### 2022-10-13
- [Add] Добавление метода `getRedirectionOrdersList` в `AdditionalService`
- [Add] Добавление метода `getReturnReasonsSubtypes` в `AdditionalService`
- [Add] Добавление метода `getReturnOrdersList` в `AdditionalService`
- [Add] Добавление метода `checkPossibilityForRedirecting` в `AdditionalService`
- [Add] Добавление метода `save` в `AdditionalService`
- [Fix] Изменение возвращения ошибок при запросах
- [Add] Добавление модели `AdditionalService` и метода `CheckPossibilityCreateReturn`
- [Add] Добавление метода `edit` в `InternetDocument` (спасибо https://github.com/seriklav) НЕ ТЕСТИРОВАЛ
- [Add] Добавление метода `getDocumentDeliveryDate` в `InternetDocument` (спасибо https://github.com/seriklav)

### 2022-09-27
- [Fix] Изменение ссылок в документацию офф сайта в коде и в документации в пакете
- [Add] Добавление в `getStatusTTN` значения `NewMoneyTTN` - номер накладной возврата денег
- [Fix] Изменение в `getStatusTTN` значения `NewTTN` при создании возвратной ТТН
- [Add] Немного изменена выдача warning и errors
- [Fix] `getWarehouseTypes`


### 2022-09-20
- [Refactor] Refactor part code (not included in the release!!! TESTING)


### 2021-03-18
- [Add] `getMoneyTransferDocuments` in InternetDocument


### 2020-10-30
- [Add] `deleteScanSheet` in ScanSheet ($ScanSheetRefs)
- [Add] `insertDocuments` in ScanSheet ($DocumentRefs, $Ref = null, $Date = null)


### 2020-10-22
- [Fix] `getWarehouses` in Address ($cityRef = null)


### 2020-10-27
- [Add][ND] `getCatalogCounterparty` in Counterparty
- [Add] `getSettlements` in Address
- [Add][ND] `prolongateKey` in CommonGeneral (NOT WORK)
- [Add] `delete` in InternetDocument
- [Fix] `checkTTN` in TrackingDocument
