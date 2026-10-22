<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class AddressTest extends TestCase
{
    public function test_save_update_delete_are_not_implemented_and_send_nothing()
    {
        Http::fake();
        $address = new Address();

        $this->assertFalse($address->save());
        $this->assertFalse($address->update());
        $this->assertFalse($address->delete());

        Http::assertNothingSent();
    }

    public function test_getCities_searches_by_string_by_default()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getCities('Київ');

        $this->assertSame('Київ', $this->sentBody()['methodProperties']['FindByString']);
    }

    public function test_getCities_searches_by_ref_when_requested()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getCities('ref-1', false);

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('ref-1', $props['Ref']);
        $this->assertArrayNotHasKey('FindByString', $props);
    }

    public function test_getCities_uses_limit_set_by_setLimit()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->setLimit(50);
        $address->getCities();

        $this->assertEquals(50, $this->sentBody()['methodProperties']['Limit']);
    }

    public function test_getCities_uses_config_page_limit_when_no_limit_set()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getCities();

        $this->assertEquals(
            config('novaposhta.page_limit'),
            $this->sentBody()['methodProperties']['Limit']
        );
    }

    public function test_getCities_passes_page()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->setPage('2');
        $address->getCities();

        $this->assertSame('2', $this->sentBody()['methodProperties']['Page']);
    }

    public function test_getWarehouses_filters_by_city_name()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getWarehouses('Київ');

        $this->assertSame('Київ', $this->sentBody()['methodProperties']['CityName']);
    }

    public function test_getWarehouses_filters_by_type_of_warehouse()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->setTypeOfWarehouseRef('type-ref');
        $address->getWarehouses();

        $this->assertSame('type-ref', $this->sentBody()['methodProperties']['TypeOfWarehouseRef']);
    }

    public function test_getWarehouseSettlements_sends_settlement_ref()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getWarehouseSettlements('settlement-ref');

        $this->assertSame('settlement-ref', $this->sentBody()['methodProperties']['SettlementRef']);
    }

    public function test_getSettlements_forces_limit_150()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->getSettlements();

        $this->assertEquals(150, $this->sentBody()['methodProperties']['Limit']);
    }

    public function test_getSettlements_applies_area_region_and_warehouse_filters()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->filterAreaRef('area-ref');
        $address->filterRegionRef('region-ref');
        $address->filterWarehouse();
        $address->getSettlements();

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('area-ref', $props['AreaRef']);
        $this->assertSame('region-ref', $props['RegionRef']);
        $this->assertEquals(1, $props['Warehouse']);
    }

    public function test_searchSettlementStreets_sends_settlement_and_street()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->searchSettlementStreets('settlement-ref', 'Шев');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('settlement-ref', $props['SettlementRef']);
        $this->assertSame('Шев', $props['StreetName']);
    }

    public function test_searchSettlements_sends_city_name()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Address())->searchSettlements('Бровари');

        $this->assertSame('Бровари', $this->sentBody()['methodProperties']['CityName']);
    }
}
