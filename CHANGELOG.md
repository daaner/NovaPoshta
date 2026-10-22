# Changelog

All notable changes to `NovaPoshta` will be documented in this file

### 2026-10-22
- [Add] Status `124` (Destroyed as a result of an enemy attack) in translations
- [Fix] Response is reset between requests in `getResponse`
- [Fix] `infoCodes` in `addInfo` is no longer overwritten by the last code; `StatusCode` and `StatusLocale` are taken from the same error
- [Fix] `StatusCode` on unsuccessful HTTP response
- [Fix] `Content-Type` check with charset
- [Fix] `getStatusDocuments`/`checkTTN`: parsing of comma-separated TTN strings, `Documents` format for NP
- [Fix] `getStatusTTN`: for an unknown status `StatusLocale` is taken from the NP response
- [Fix] Typo in the en translation of `30000901047`
- [Docs] Documentation translated into Ukrainian (default language), Russian version moved to `docs/ru`, language switcher
- [Docs] `README.md` in Ukrainian, Russian version in `README.ru.md`
- [Docs] Docsify updated to v5, light/dark/system theme switcher, favicon

### 2025-11-23
- [Add] Added method `payEwByLoyaltyPoints` to `InternetDocument`
- [Add] Added method `registrationLoyaltyUserByPhone` to `LoyaltyUser`
- [Add] Added method `activationLoyaltyUserByPhone` to `LoyaltyUser`

### 2024-07-04
- [Add] Added method `ChangeAfterpaymentType` to `AdditionalService`

### 2024-06-13
- [Add] Added method `setAfterpaymentOnGoodsCost` to `InternetDocument`

### 2023-03-25
- [Fix] Fixed removal of cash on delivery from a request in `AdditionalService`

### 2022-12-01
- [Fix] Changed the payer for cash on delivery change to `Recipient` in `orderChangeEW`

### 2022-11-07
- [Add] Added method `createApiKey` to `CommonGeneral`
- [Add] Added method `deleteApiKey` to `CommonGeneral`
- [Add] Added method `saveAddTerm` to `AdditionalService`
- [Add] Added method `saveChangeCash` to `AdditionalService`
- [Add] Added method `getDocumentPrice` to `InternetDocument`
- [Fix] Removed the 3rd and 4th parameters of `getDocumentDeliveryDate` in `InternetDocument` (Breaking change)

### 2022-11-06
- [Add] Added method `getPDF` to `InternetDocument`
- [Add] Added the ability to print a scan sheet with `setThisIsScansheet()`

### 2022-11-05
- [Add] `infoCodes` are now returned in the `info` key of the response
- [Add] Added method `getPersonalManager` to `Common`
- [Add] Added method `getLoyaltyCardTurnoverByApiKey` to `LoyaltyUser`
- [Add] Added method `getPromocodeByPhone` to `LoyaltyUser`
- [Add] Added method `getStandartCardsList` to `LoyaltyUser`
- [Add] Added model `InventoryGeneral` and method `getInventoryNomenclaturesList`
- [Add] Added model `CarCallGeneral` and method `getOrdersList`
- [Add] Added method `getInventoryOrdersList` to `InventoryGeneral`

### 2022-11-03
- [Fix] Fix part returns
- [Fix] Rename `addLimit()` to `getLimit()`
- [Refactor] Rebuild `getResponse()`

### 2022-11-02
- [Fix] Slightly changed the second parameter of `save` in `AdditionalService` (Breaking change)
- [Fix] Slightly changed the second parameter of `saveRedirecting` in `AdditionalService` (Breaking change)

### 2022-10-28
- [Add] Added storage extension check method `CheckPossibilityTermExtension` to `AdditionalService`
- [Add] Added change check method `CheckPossibilityChangeEW` to `AdditionalService`
- [Add] Added payment cards method `walletManagement` to `Payment`
- [Add] Added API keys list method `getApiKeysList` to `CommonGeneral`
- [Add] Added method `getTrustedDevicesList` to `CommonGeneral`
- [Add] Added method `deleteTrustedDevice` to `CommonGeneral`
- [Fix] Fixed method `prolongateApiKey` in model `CommonGeneral`
- [Fix] Disabled publishing of translations, since they had to be re-published after every change, which complicated usage

### 2022-10-21
- [Add] Added redirect method `saveRedirecting` or `save($ttn, 'orderRedirecting')` to `AdditionalService`

### 2022-10-14
- [Add] Added method `delete` to `AdditionalService`

### 2022-10-13
- [Add] Added method `getRedirectionOrdersList` to `AdditionalService`
- [Add] Added method `getReturnReasonsSubtypes` to `AdditionalService`
- [Add] Added method `getReturnOrdersList` to `AdditionalService`
- [Add] Added method `checkPossibilityForRedirecting` to `AdditionalService`
- [Add] Added method `save` to `AdditionalService`
- [Fix] Changed how request errors are returned
- [Add] Added model `AdditionalService` and method `CheckPossibilityCreateReturn`
- [Add] Added method `edit` to `InternetDocument` (thanks https://github.com/seriklav) NOT TESTED
- [Add] Added method `getDocumentDeliveryDate` to `InternetDocument` (thanks https://github.com/seriklav)

### 2022-09-27
- [Fix] Updated links to the official documentation in the code and in the package documentation
- [Add] Added `NewMoneyTTN` to `getStatusTTN` - the money return waybill number
- [Fix] Changed `NewTTN` in `getStatusTTN` when a return waybill is created
- [Add] Slightly changed the output of warnings and errors
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
- [Add] ND `getCatalogCounterparty` in Counterparty
- [Add] `getSettlements` in Address
- [Add] ND `prolongateKey` in CommonGeneral (NOT WORK)
- [Add] `delete` in InternetDocument
- [Fix] `checkTTN` in TrackingDocument
