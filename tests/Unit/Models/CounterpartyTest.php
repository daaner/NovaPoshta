<?php

namespace Daaner\NovaPoshta\Tests\Unit\Models;

use Daaner\NovaPoshta\Models\Counterparty;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class CounterpartyTest extends TestCase
{
    public function test_save_creates_private_person_by_default()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Counterparty())->save('Іван', 'Петренко', 'Олегович', '380501234567', 'a@b.ua');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('PrivatePerson', $props['CounterpartyType']);
        $this->assertSame('Іван', $props['FirstName']);
        $this->assertSame('Петренко', $props['LastName']);
        $this->assertSame('Олегович', $props['MiddleName']);
        $this->assertSame('380501234567', $props['Phone']);
        $this->assertSame('a@b.ua', $props['Email']);
    }

    public function test_save_skips_optional_fields_when_empty()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Counterparty())->save('Іван');

        $props = $this->sentBody()['methodProperties'];
        $this->assertArrayNotHasKey('LastName', $props);
        $this->assertArrayNotHasKey('MiddleName', $props);
        $this->assertArrayNotHasKey('Phone', $props);
        $this->assertArrayNotHasKey('Email', $props);
    }

    public function test_save_for_third_person_omits_first_name()
    {
        Http::fake(['*' => $this->okResponse()]);

        $counterparty = new Counterparty();
        $counterparty->setCounterpartyProperty('ThirdPerson');
        $counterparty->save('Іван');

        $props = $this->sentBody()['methodProperties'];
        $this->assertArrayNotHasKey('FirstName', $props);
        $this->assertSame('ThirdPerson', $props['CounterpartyProperty']);
    }

    public function test_save_with_ownership_form_creates_organization()
    {
        Http::fake(['*' => $this->okResponse()]);

        $counterparty = new Counterparty();
        $counterparty->setOwnershipForm('ownership-ref');
        $counterparty->save('ТОВ Ромашка');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('Organization', $props['CounterpartyType']);
        $this->assertSame('ownership-ref', $props['OwnershipForm']);
    }

    public function test_save_with_edrpou_marks_third_person()
    {
        Http::fake(['*' => $this->okResponse()]);

        $counterparty = new Counterparty();
        $counterparty->setEDRPOU('12345678');
        $counterparty->save('ТОВ Ромашка');

        $props = $this->sentBody()['methodProperties'];
        $this->assertSame('12345678', $props['EDRPOU']);
        $this->assertSame('ThirdPerson', $props['CounterpartyProperty']);
    }

    public function test_getCounterparties_defaults_to_recipient_property()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Counterparty())->getCounterparties();

        $this->assertSame('Recipient', $this->sentBody()['methodProperties']['CounterpartyProperty']);
    }

    public function test_getCounterparties_with_all_property_omits_it()
    {
        Http::fake(['*' => $this->okResponse()]);

        $counterparty = new Counterparty();
        $counterparty->setCounterpartyProperty('All');
        $counterparty->getCounterparties();

        $this->assertArrayNotHasKey('CounterpartyProperty', $this->sentBody()['methodProperties']);
    }

    public function test_getCounterparties_finds_by_string()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Counterparty())->getCounterparties('Ромашка');

        $this->assertSame('Ромашка', $this->sentBody()['methodProperties']['FindByString']);
    }

    public function test_getCounterpartyAddresses_sends_ref()
    {
        Http::fake(['*' => $this->okResponse()]);

        (new Counterparty())->getCounterpartyAddresses('cp-ref');

        $this->assertSame('cp-ref', $this->sentBody()['methodProperties']['Ref']);
    }
}
