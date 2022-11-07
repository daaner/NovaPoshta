# Changelog

All notable changes to `NovaPoshta` will be documented in this file

### 2022-11-07
- [Add] Добавление метода `createApiKey` в `CommonGeneral`
- [Add] Добавление метода `deleteApiKey` в `CommonGeneral`
- [Add] Добавление метода `saveAddTerm` в `AdditionalService`
- [Add] Добавление метода `saveChangeCash` в `AdditionalService`
- [Add] Добавление метода `getDocumentPrice` в `InternetDocument`
- [Fix] Убрал 3 и 4 параметр в методе `getDocumentDeliveryDate` в `InternetDocument` (Ломает обратку)

### 2022-11-06
- [Add] Добавление метода `getPDF` в `InternetDocument`
- [Add] Добавление возможности распечатывать реестр методом `setThisIsScansheet()`

### 2022-11-05
- [Add] Добавлен вывод `infoCodes` в ответе в ключе `info`
- [Add] Добавление метода `getPersonalManager` в `Common`
- [Add] Добавление метода `getLoyaltyCardTurnoverByApiKey` в `LoyaltyUser`
- [Add] Добавление метода `getPromocodeByPhone` в `LoyaltyUser`
- [Add] Добавление метода `getStandartCardsList` в `LoyaltyUser`
- [Add] Добавление модели `InventoryGeneral` и метода `getInventoryNomenclaturesList`
- [Add] Добавление модели `CarCallGeneral` и метода `getOrdersList`
- [Add] Добавление метода `getInventoryOrdersList` в `InventoryGeneral`

### 2022-11-03
- [Fix] Fix part returns
- [Fix] Rename `addLimit()` to `getLimit()`
- [Refactor] Rebuild `getResponse()`

### 2022-11-02
- [Fix] Немного поменял второй параметр в методе `save` в `AdditionalService` (Ломает обратку)
- [Fix] Немного поменял второй параметр в методе `saveRedirecting` в `AdditionalService` (Ломает обратку)

### 2022-10-28
- [Add] Добавление метода переадресации `CheckPossibilityTermExtension` в `AdditionalService`
- [Add] Добавление метода проверки изменения `CheckPossibilityChangeEW` в `AdditionalService`
- [Add] Добавление метода вывода карт оплаты `walletManagement` в `Payment`
- [Add] Добавление метода вывод API ключей `getApiKeysList` в `CommonGeneral`
- [Add] Добавление метода `getTrustedDevicesList` в `CommonGeneral`
- [Add] Добавление метода `deleteTrustedDevice` в `CommonGeneral`
- [Fix] Исправление методе `prolongateApiKey` в модели `CommonGeneral`
- [Fix] Отключил импорт локализаций, так как при изменении нужно обновлять, что усложняет пользование

### 2022-10-21
- [Add] Добавление метода переадресации `saveRedirecting` или `save($ttn, 'orderRedirecting')` в `AdditionalService`

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
