<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\ScanSheet;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ScanSheetTest extends TestCase
{
    public function test_insertDocuments_splits_string_refs()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new ScanSheet())->insertDocuments('ttn-1, ttn-2');

        $this->assertSame(['ttn-1', 'ttn-2'], $this->sentBody()['methodProperties']['DocumentRefs']);
    }

    public function test_insertDocuments_sends_ref_and_date()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new ScanSheet())->insertDocuments(['ttn-1'], 'sheet-ref', '2026-10-22');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('sheet-ref', $props['Ref']);
        $this->assertSame('22.10.2026', $props['Date']);
    }

    public function test_removeDocuments_sends_ref_when_given()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new ScanSheet())->removeDocuments(['ttn-1'], 'sheet-ref');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('sheet-ref', $props['Ref']);
        $this->assertSame(['ttn-1'], $props['DocumentRefs']);
    }

    public function test_deleteScanSheet_wraps_single_ref_in_array()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new ScanSheet())->deleteScanSheet('sheet-ref');

        $this->assertSame(['sheet-ref'], $this->sentBody()['methodProperties']['ScanSheetRefs']);
    }

    public function test_updateScanSheet_sends_ref_and_description()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new ScanSheet())->updateScanSheet('sheet-ref', 'Ранок');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('sheet-ref', $props['Ref']);
        $this->assertSame('Ранок', $props['Description']);
    }
}
