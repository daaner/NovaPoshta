<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\InternetDocument;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class InternetDocumentTest extends TestCase
{
    public function test_save_uses_given_description()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->save('Книги');

        $this->assertSame('Книги', $this->sentBody()['methodProperties']['Description']);
    }

    public function test_save_sends_cost_and_seats_amount()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setCost('500');
        $document->setSeatsAmount('2');
        $document->save();

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('500', $props['Cost']);
        $this->assertSame('2', $props['SeatsAmount']);
    }

    public function test_save_uses_default_seat_when_none_set()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->save();

        $seat = $this->sentBody()['methodProperties']['OptionsSeat'];
        $this->assertSame('1', $seat['weight']);
        $this->assertSame('24', $seat['volumetricWidth']);
    }

    public function test_save_adds_backward_delivery_data()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setBackwardDeliveryData('300');
        $document->save();

        $data = $this->sentBody()['methodProperties']['BackwardDeliveryData'];
        $this->assertSame('300', $data[0]['RedeliveryString']);
    }

    public function test_save_takes_sender_from_setSender()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setSender([
            'Sender' => 'sender-ref',
            'CitySender' => 'city-ref',
            'SenderAddress' => 'address-ref',
            'ContactSender' => 'contact-ref',
            'SendersPhone' => '380501234567',
        ]);
        $document->save();

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('sender-ref', $props['Sender']);
        $this->assertSame('city-ref', $props['CitySender']);
        $this->assertSame('380501234567', $props['SendersPhone']);
    }

    public function test_save_sends_date_time_from_setDateTime()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setDateTime('2026-10-22');
        $document->save();

        $this->assertSame('22.10.2026', $this->sentBody()['methodProperties']['DateTime']);
    }

    public function test_delete_splits_comma_separated_refs()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->delete('20400000000001, 20400000000002');

        $this->assertSame(
            ['20400000000001', '20400000000002'],
            $this->sentBody()['methodProperties']['DocumentRefs']
        );
    }

    public function test_getDocumentPrice_sends_weight_from_setWeight()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setWeight('2');
        $document->getDocumentPrice('city-1', 'city-2');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('2', $props['Weight']);
        $this->assertSame('city-1', $props['CitySender']);
        $this->assertSame('city-2', $props['CityRecipient']);
    }

    public function test_getDocumentList_sends_date_from_setDateTimeFrom()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setDateTimeFrom('2026-10-01');
        $document->getDocumentList();

        $this->assertSame('01.10.2026', $this->sentBody()['methodProperties']['DateTimeFrom']);
    }

    public function test_getMoneyTransferDocuments_formats_dates_with_time()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->getMoneyTransferDocuments('2026-10-01', '2026-10-05');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('01.10.2026 00:00:00', $props['DateFrom']);
        $this->assertSame('05.10.2026 00:00:00', $props['DateTo']);
    }

    public function test_getPDF_splits_string_refs()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->getPDF('20400000000001, 20400000000002', false);

        $this->assertCount(2, $this->sentBody()['methodProperties']['DocumentRefs']);
    }

    public function test_getPDF_as_scansheet_sends_scansheet_refs()
    {
        Http::fake(['*' => $this->okResponse()]);

        $document = new InternetDocument();
        $document->setThisIsScansheet();
        $document->getPDF(['ref-1', 'ref-2'], false);

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame(['ref-1', 'ref-2'], $props['ScanSheetRefs']);
        $this->assertArrayNotHasKey('DocumentRefs', $props);
    }

    public function test_getPDF_streamed_returns_pdf_response()
    {
        Http::fake(['*' => Http::response('%PDF-1.4', 200, ['Content-Type' => 'application/pdf'])]);

        $response = (new InternetDocument())->getPDF(['ttn'], true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/pdf', $response->headers->get('Content-Type'));
    }

    public function test_getPDF_streamed_returns_500_when_api_gives_no_file()
    {
        Http::fake(['*' => Http::response([
            'success' => false,
            'errors' => ['bad'],
        ], 200, ['Content-Type' => 'application/json'])]);

        $response = (new InternetDocument())->getPDF(['ttn'], true);

        $this->assertSame(500, $response->getStatusCode());
    }

    public function test_payEwByLoyaltyPoints_sends_document_and_amount()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new InternetDocument())->payEwByLoyaltyPoints('ttn', '10');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('ttn', $props['DocumentNumber']);
        $this->assertSame('10', $props['DebitingAmount']);
    }
}
