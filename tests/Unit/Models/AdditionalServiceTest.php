<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\AdditionalService;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class AdditionalServiceTest extends TestCase
{
    public function test_save_defaults_to_cargo_return_order_type()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->save('ttn');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('ttn', $props['IntDocNumber']);
        $this->assertSame('orderCargoReturn', $props['OrderType']);
        $this->assertArrayHasKey('Note', $props);
    }

    public function test_save_cargo_return_uses_return_address_ref()
    {
        Http::fake(['*' => $this->okResponse()]);

        $service = new AdditionalService();
        $service->setReturnAddressRef('return-address-ref');
        $service->save('ttn');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('return-address-ref', $props['ReturnAddressRef']);
        $this->assertArrayNotHasKey('RecipientWarehouse', $props);
    }

    public function test_saveRedirecting_sets_redirect_order_and_customer()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->saveRedirecting('ttn');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('orderRedirecting', $props['OrderType']);
        $this->assertSame('Sender', $props['Customer']);
    }

    public function test_saveAddTerm_sends_term_extension_without_return_reason()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->saveAddTerm('ttn');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('orderTermExtension', $props['OrderType']);
        $this->assertArrayNotHasKey('Reason', $props);
    }

    public function test_saveChangeCash_adds_recipient_backward_delivery()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->saveChangeCash('ttn', '100');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('orderChangeEW', $props['OrderType']);
        $this->assertSame('Recipient', $props['PayerType']);
        $this->assertSame('100', $props['BackwardDeliveryData'][0]['Description']);
    }

    public function test_saveChangeCash_with_null_removes_cash_on_delivery()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->saveChangeCash('ttn', null);

        $this->assertSame([], $this->sentBody()['methodProperties']['BackwardDeliveryData']);
    }

    public function test_saveChangeAfterpaymentType_sets_control_and_clears_backward_delivery()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->saveChangeAfterpaymentType('ttn', '200');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('200', $props['AfterpaymentOnGoodsCost']);
        $this->assertSame([], $props['BackwardDeliveryData']);
    }

    public function test_getReturnReasonsSubtypes_sends_given_reason()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->getReturnReasonsSubtypes('reason-ref');

        $this->assertSame('reason-ref', $this->sentBody()['methodProperties']['ReasonRef']);
    }

    public function test_getRedirectionOrdersList_sends_number_filter()
    {
        Http::fake(['*' => $this->okResponse()]);

        $service = new AdditionalService();
        $service->setNumber('102-00010160');
        $service->getRedirectionOrdersList();

        $this->assertSame('102-00010160', $this->sentBody()['methodProperties']['Number']);
    }

    public function test_delete_sends_ref()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new AdditionalService())->delete('request-ref');

        $this->assertSame('request-ref', $this->sentBody()['methodProperties']['Ref']);
    }
}
