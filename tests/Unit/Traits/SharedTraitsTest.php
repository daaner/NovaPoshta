<?php

namespace Daaner\NovaPoshta\Tests\Unit\Traits;

use Carbon\Carbon;
use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\Common;
use Daaner\NovaPoshta\Models\ScanSheet;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class SharedTraitsTest extends TestCase
{
    public function test_checkDate_formats_carbon_instance()
    {
        $this->assertSame('22.10.2026', (new ScanSheet())->checkDate(Carbon::create(2026, 10, 22)));
    }

    public function test_checkDate_falls_back_to_today_on_invalid_string()
    {
        $this->assertSame(
            Carbon::now()->format('d.m.Y'),
            (new ScanSheet())->checkDate('not a date')
        );
    }

    public function test_CommonFilter_sends_dimensions_for_pack_list()
    {
        Http::fake(['*' => $this->okResponse()]);

        $common = new Common();
        $common->setLength(10);
        $common->setWidth(5);
        $common->setHeight(3);
        $common->setVolumetricWeight(2);
        $common->getPackList();

        $props = $this->sentBody()['methodProperties'];
        $this->assertEquals(10, $props['Length']);
        $this->assertEquals(5, $props['Width']);
        $this->assertEquals(3, $props['Height']);
        $this->assertEquals(2, $props['VolumetricWeight']);
    }

    public function test_WarehousesFilter_flags_are_sent()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->filterBicycleParking();
        $address->filterPostFinance();
        $address->getWarehouses();

        $props = $this->sentBody()['methodProperties'];
        $this->assertEquals(1, $props['BicycleParking']);
        $this->assertEquals(1, $props['PostFinance']);
    }

    public function test_Address_filterRef_is_sent_for_settlements()
    {
        Http::fake(['*' => $this->okResponse()]);

        $address = new Address();
        $address->filterRef('settlement-ref');
        $address->getSettlements();

        $this->assertSame('settlement-ref', $this->sentBody()['methodProperties']['Ref']);
    }

    public function test_getPersonalManager_sends_counterparty_ref()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Common())->getPersonalManager('cp-ref');

        $this->assertSame('cp-ref', $this->sentBody()['methodProperties']['Ref']);
    }
}
