<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

/**
 * Smoke-покрытие всех публичных методов моделей:
 * метод уходит в нужную модель / calledMethod, apiKey есть только там, где нужен.
 */
class ApiMethodsTest extends TestCase
{
    /**
     * @dataProvider apiCalls
     */
    public function test_public_method_sends_expected_request(string $model, string $method, array $args, string $calledMethod, bool $withKey)
    {
        Http::fake(['*' => $this->okResponse()]);

        $class = 'Daaner\\NovaPoshta\\Models\\'.$model;
        $instance = new $class();

        $instance->{$method}(...$args);

        $this->assertApiRequest($model, $calledMethod, $withKey);
    }

    public function apiCalls(): array
    {
        $phone = '380501234567';

        return [
            // Address (без авторизации)
            'Address::getAreas' => ['Address', 'getAreas', [], 'getAreas', false],
            'Address::getCities' => ['Address', 'getCities', [], 'getCities', false],
            'Address::getWarehouses' => ['Address', 'getWarehouses', [], 'getWarehouses', false],
            'Address::getWarehouseTypes' => ['Address', 'getWarehouseTypes', [], 'getWarehouseTypes', false],
            'Address::getWarehouseSettlements' => ['Address', 'getWarehouseSettlements', ['ref'], 'getWarehouses', false],
            'Address::searchSettlements' => ['Address', 'searchSettlements', ['Київ'], 'searchSettlements', false],
            'Address::searchSettlementStreets' => ['Address', 'searchSettlementStreets', ['ref', 'Шев'], 'searchSettlementStreets', false],
            'Address::getStreet' => ['Address', 'getStreet', ['ref'], 'getStreet', false],
            'Address::getSettlements' => ['Address', 'getSettlements', [], 'getSettlements', false],

            // Counterparty (с авторизацией)
            'Counterparty::getCounterparties' => ['Counterparty', 'getCounterparties', [], 'getCounterparties', true],
            'Counterparty::getCounterpartyContactPerson' => ['Counterparty', 'getCounterpartyContactPerson', ['ref'], 'getCounterpartyContactPersons', true],
            'Counterparty::save' => ['Counterparty', 'save', ['Іван'], 'save', true],
            'Counterparty::getCounterpartyOptions' => ['Counterparty', 'getCounterpartyOptions', ['ref'], 'getCounterpartyOptions', true],
            'Counterparty::getCounterpartyAddresses' => ['Counterparty', 'getCounterpartyAddresses', ['ref'], 'getCounterpartyAddresses', true],
            'Counterparty::getCatalogCounterparty' => ['Counterparty', 'getCatalogCounterparty', [$phone, 'Петренко'], 'getCatalogCounterparty', true],

            // Common
            'Common::getOwnershipFormsList' => ['Common', 'getOwnershipFormsList', [], 'getOwnershipFormsList', false],
            'Common::getPaymentForms' => ['Common', 'getPaymentForms', [], 'getPaymentForms', false],
            'Common::getTypesOfCounterparties' => ['Common', 'getTypesOfCounterparties', [], 'getTypesOfCounterparties', false],
            'Common::getServiceTypes' => ['Common', 'getServiceTypes', [], 'getServiceTypes', false],
            'Common::getCargoDescriptionList' => ['Common', 'getCargoDescriptionList', [], 'getCargoDescriptionList', false],
            'Common::getTiresWheelsList' => ['Common', 'getTiresWheelsList', [], 'getTiresWheelsList', false],
            'Common::getPackList' => ['Common', 'getPackList', [], 'getPackList', false],
            'Common::getTypesOfPayersForRedelivery' => ['Common', 'getTypesOfPayersForRedelivery', [], 'getTypesOfPayersForRedelivery', false],
            'Common::getTypesOfPayers' => ['Common', 'getTypesOfPayers', [], 'getTypesOfPayers', false],
            'Common::getPalletsList' => ['Common', 'getPalletsList', [], 'getPalletsList', false],
            'Common::getBackwardDeliveryCargoTypes' => ['Common', 'getBackwardDeliveryCargoTypes', [], 'getBackwardDeliveryCargoTypes', false],
            'Common::getCargoTypes' => ['Common', 'getCargoTypes', [], 'getCargoTypes', false],
            'Common::getTimeIntervals' => ['Common', 'getTimeIntervals', ['ref'], 'getTimeIntervals', false],
            'Common::getPersonalManager' => ['Common', 'getPersonalManager', ['ref'], 'getPersonalManager', true],

            // CommonGeneral
            'CommonGeneral::getMessageCodeText' => ['CommonGeneral', 'getMessageCodeText', [], 'getMessageCodeText', false],
            'CommonGeneral::prolongateKey' => ['CommonGeneral', 'prolongateKey', ['key', 6], 'prolongateApiKey', true],
            'CommonGeneral::getApiKeysList' => ['CommonGeneral', 'getApiKeysList', [], 'getApiKeysList', true],
            'CommonGeneral::getTrustedDevicesList' => ['CommonGeneral', 'getTrustedDevicesList', [], 'getTrustedDevicesList', true],
            'CommonGeneral::deleteTrustedDevice' => ['CommonGeneral', 'deleteTrustedDevice', ['ref'], 'deleteTrustedDevice', true],
            'CommonGeneral::createApiKey' => ['CommonGeneral', 'createApiKey', [], 'createApiKey', true],
            'CommonGeneral::deleteApiKey' => ['CommonGeneral', 'deleteApiKey', ['key'], 'deleteApiKey', true],

            // InventoryGeneral / CarCallGeneral / Payment
            'InventoryGeneral::getInventoryNomenclaturesList' => ['InventoryGeneral', 'getInventoryNomenclaturesList', [], 'getInventoryNomenclaturesList', true],
            'InventoryGeneral::getInventoryOrdersList' => ['InventoryGeneral', 'getInventoryOrdersList', [], 'getInventoryOrdersList', true],
            'CarCallGeneral::getOrdersList' => ['CarCallGeneral', 'getOrdersList', [], 'getOrdersList', true],
            'Payment::walletManagement' => ['Payment', 'walletManagement', [], 'walletManagement', true],

            // LoyaltyUser
            'LoyaltyUser::getLoyaltyInfoByApiKey' => ['LoyaltyUser', 'getLoyaltyInfoByApiKey', [], 'getLoyaltyInfoByApiKey', true],
            'LoyaltyUser::getLoyaltyCardTurnoverByApiKey' => ['LoyaltyUser', 'getLoyaltyCardTurnoverByApiKey', ['2026', '10'], 'getLoyaltyCardTurnoverByApiKey', true],
            'LoyaltyUser::getPromocodeByPhone' => ['LoyaltyUser', 'getPromocodeByPhone', [$phone], 'getPromocodeByPhone', true],
            'LoyaltyUser::getStandartCardsList' => ['LoyaltyUser', 'getStandartCardsList', ['ref'], 'getStandartCardsList', true],
            'LoyaltyUser::registrationLoyaltyUserByPhone' => ['LoyaltyUser', 'registrationLoyaltyUserByPhone', [$phone, 'pass'], 'registrationLoyaltyUserByPhone', true],
            'LoyaltyUser::activationLoyaltyUserByPhone' => ['LoyaltyUser', 'activationLoyaltyUserByPhone', [$phone, '1234'], 'activationLoyaltyUserByPhone', true],

            // ScanSheet
            'ScanSheet::deleteScanSheet' => ['ScanSheet', 'deleteScanSheet', ['ref'], 'deleteScanSheet', true],
            'ScanSheet::insertDocuments' => ['ScanSheet', 'insertDocuments', ['ttn'], 'insertDocuments', true],
            'ScanSheet::getScanSheetList' => ['ScanSheet', 'getScanSheetList', [], 'getScanSheetList', true],
            'ScanSheet::getScanSheet' => ['ScanSheet', 'getScanSheet', ['ref'], 'getScanSheet', true],
            'ScanSheet::removeDocuments' => ['ScanSheet', 'removeDocuments', ['ttn'], 'removeDocuments', true],
            'ScanSheet::getScanSheetDocuments' => ['ScanSheet', 'getScanSheetDocuments', ['ref'], 'getScanSheetDocuments', true],
            'ScanSheet::updateScanSheet' => ['ScanSheet', 'updateScanSheet', ['ref', 'desc'], 'updateScanSheet', true],

            // InternetDocument
            'InternetDocument::getDocumentList' => ['InternetDocument', 'getDocumentList', [], 'getDocumentList', true],
            'InternetDocument::save' => ['InternetDocument', 'save', [], 'save', true],
            'InternetDocument::delete' => ['InternetDocument', 'delete', ['ttn'], 'delete', true],
            'InternetDocument::getMoneyTransferDocuments' => ['InternetDocument', 'getMoneyTransferDocuments', [], 'getMoneyTransferDocuments', true],
            'InternetDocument::edit' => ['InternetDocument', 'edit', [], 'update', true],
            'InternetDocument::getDocumentDeliveryDate' => ['InternetDocument', 'getDocumentDeliveryDate', ['c1', 'c2'], 'getDocumentDeliveryDate', false],
            'InternetDocument::getDocumentPrice' => ['InternetDocument', 'getDocumentPrice', ['c1', 'c2'], 'getDocumentPrice', false],
            'InternetDocument::getPDF' => ['InternetDocument', 'getPDF', [['ttn'], false], 'printFull', true],
            'InternetDocument::payEwByLoyaltyPoints' => ['InternetDocument', 'payEwByLoyaltyPoints', ['ttn', '10'], 'payEwByLoyaltyPoints', true],

            // AdditionalService
            'AdditionalService::CheckPossibilityCreateReturn' => ['AdditionalService', 'CheckPossibilityCreateReturn', ['ttn'], 'CheckPossibilityCreateReturn', true],
            'AdditionalService::checkPossibilityForRedirecting' => ['AdditionalService', 'checkPossibilityForRedirecting', ['ttn'], 'checkPossibilityForRedirecting', true],
            'AdditionalService::getReturnReasons' => ['AdditionalService', 'getReturnReasons', [], 'getReturnReasons', false],
            'AdditionalService::getReturnReasonsSubtypes' => ['AdditionalService', 'getReturnReasonsSubtypes', [], 'getReturnReasonsSubtypes', false],
            'AdditionalService::getReturnOrdersList' => ['AdditionalService', 'getReturnOrdersList', [], 'getReturnOrdersList', true],
            'AdditionalService::getRedirectionOrdersList' => ['AdditionalService', 'getRedirectionOrdersList', [], 'getRedirectionOrdersList', true],
            'AdditionalService::save' => ['AdditionalService', 'save', ['ttn'], 'save', true],
            'AdditionalService::saveRedirecting' => ['AdditionalService', 'saveRedirecting', ['ttn'], 'save', true],
            'AdditionalService::saveAddTerm' => ['AdditionalService', 'saveAddTerm', ['ttn'], 'save', true],
            'AdditionalService::saveChangeCash' => ['AdditionalService', 'saveChangeCash', ['ttn', '100'], 'save', true],
            'AdditionalService::saveChangeAfterpaymentType' => ['AdditionalService', 'saveChangeAfterpaymentType', ['ttn', '200'], 'save', true],
            'AdditionalService::delete' => ['AdditionalService', 'delete', ['ref'], 'delete', true],
            'AdditionalService::CheckPossibilityTermExtension' => ['AdditionalService', 'CheckPossibilityTermExtension', ['ttn'], 'CheckPossibilityTermExtension', true],
            'AdditionalService::CheckPossibilityChangeEW' => ['AdditionalService', 'CheckPossibilityChangeEW', ['ttn'], 'CheckPossibilityChangeEW', true],

            // TrackingDocument
            'TrackingDocument::getStatusDocuments' => ['TrackingDocument', 'getStatusDocuments', ['20400000000000'], 'getStatusDocuments', true],
            'TrackingDocument::checkTTN' => ['TrackingDocument', 'checkTTN', ['20400000000000'], 'getStatusDocuments', true],
            'TrackingDocument::getStatusTTN' => ['TrackingDocument', 'getStatusTTN', ['20400000000000'], 'getStatusDocuments', true],
        ];
    }
}
