<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\TrackingDocument;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TrackingDocumentTest extends TestCase
{
    public function test_clearNumber_keeps_only_digits()
    {
        $this->assertSame('123456', (new TrackingDocument())->clearNumber('abc 12-34 56 '));
    }

    public function test_getStatusDocuments_splits_comma_separated_string_and_cleans_numbers()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new TrackingDocument())->getStatusDocuments('204-000 0000001, 20400000000002');

        $docs = $this->sentBody()['methodProperties']['Documents'];
        $this->assertCount(2, $docs);
        $this->assertSame('2040000000001', $docs[0]['DocumentNumber']);
        $this->assertSame('20400000000002', $docs[1]['DocumentNumber']);
        $this->assertNull($docs[0]['Phone']);
    }

    public function test_getStatusDocuments_accepts_array_of_numbers_and_skips_empty()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new TrackingDocument())->getStatusDocuments(['20400000000001', '', 'abc']);

        $docs = $this->sentBody()['methodProperties']['Documents'];
        $this->assertCount(1, $docs);
        $this->assertSame('20400000000001', $docs[0]['DocumentNumber']);
    }

    public function test_getStatusDocuments_keeps_ready_made_document_arrays()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new TrackingDocument())->getStatusDocuments([
            ['DocumentNumber' => '20400000000001', 'Phone' => '380501234567'],
        ]);

        $docs = $this->sentBody()['methodProperties']['Documents'];
        $this->assertSame('380501234567', $docs[0]['Phone']);
    }

    public function test_checkTTN_applies_phone_to_every_document()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new TrackingDocument())->checkTTN('20400000000001, 20400000000002', '380501234567');

        $docs = $this->sentBody()['methodProperties']['Documents'];
        $this->assertCount(2, $docs);
        $this->assertSame('380501234567', $docs[0]['Phone']);
        $this->assertSame('380501234567', $docs[1]['Phone']);
    }

    public function test_getStatusTTN_maps_status_and_new_ttn()
    {
        Http::fake(['*' => $this->okResponse([[
            'Number' => '20400000000001',
            'StatusCode' => '99999',
            'Status' => 'Custom status',
            'ActualDeliveryDate' => null,
            'LastCreatedOnTheBasisNumber' => '20400000000002',
        ]])]);

        $result = (new TrackingDocument())->getStatusTTN('20400000000001');

        $this->assertTrue($result['success']);
        $this->assertSame('20400000000001', $result['result'][0]['Number']);
        $this->assertSame('99999', $result['result'][0]['StatusCode']);
        // Неизвестный код -> текст от НП
        $this->assertSame('Custom status', $result['result'][0]['StatusLocale']);
        $this->assertSame('20400000000002', $result['result'][0]['NewTTN']);
        $this->assertSame('', $result['result'][0]['NewMoneyTTN']);
    }

    public function test_getStatusTTN_puts_money_return_number_into_NewMoneyTTN()
    {
        Http::fake(['*' => $this->okResponse([[
            'Number' => '20400000000001',
            'StatusCode' => '99999',
            'Status' => 'Custom',
            'LastCreatedOnTheBasisNumber' => '204-1',
        ]])]);

        $result = (new TrackingDocument())->getStatusTTN('20400000000001');

        $this->assertSame('204-1', $result['result'][0]['NewMoneyTTN']);
        $this->assertSame('', $result['result'][0]['NewTTN']);
    }

    public function test_getStatusTTN_returns_empty_result_on_api_failure()
    {
        Http::fake(['*' => $this->okResponse([], false)]);

        $result = (new TrackingDocument())->getStatusTTN('20400000000001');

        $this->assertFalse($result['success']);
        $this->assertSame([], $result['result']);
    }
}
