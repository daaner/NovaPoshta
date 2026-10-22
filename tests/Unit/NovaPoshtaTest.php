<?php

namespace Daaner\NovaPoshta\Tests\Unit;

use Daaner\NovaPoshta\Facades\NovaPoshta as NovaPoshtaFacade;
use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class NovaPoshtaTest extends TestCase
{
    private function api(): NovaPoshta
    {
        return $this->app->make(NovaPoshta::class);
    }

    public function test_container_resolves_the_package_singleton()
    {
        $this->assertInstanceOf(NovaPoshta::class, $this->app->make('novaposhta'));
        $this->assertSame($this->app->make('novaposhta'), $this->app->make('novaposhta'));
    }

    public function test_facade_returns_package_instance()
    {
        $this->assertInstanceOf(NovaPoshta::class, NovaPoshtaFacade::getFacadeRoot());
    }

    public function test_successful_response_is_parsed()
    {
        Http::fake(['*' => $this->okResponse([['Ref' => 'abc']])]);

        $result = $this->api()->getResponse('Address', 'getCities', []);

        $this->assertTrue($result['success']);
        $this->assertSame([['Ref' => 'abc']], $result['result']);
    }

    public function test_api_errors_are_exposed_in_info()
    {
        Http::fake(['*' => Http::response([
            'success' => false,
            'data' => [],
            'errors' => ['Invalid key'],
            'errorCodes' => ['20000200068'],
        ], 200, ['Content-Type' => 'application/json'])]);

        $result = $this->api()->getResponse('Address', 'getCities', []);

        $this->assertFalse($result['success']);
        $this->assertSame(['Invalid key'], $result['info']['errors']);
        $this->assertSame('20000200068', $result['info']['StatusCode']);
    }

    public function test_http_failure_returns_status_code()
    {
        Http::fake(['*' => Http::response('', 500)]);

        $result = $this->api()->getResponse('Address', 'getCities', []);

        $this->assertFalse($result['success']);
        $this->assertSame('500', $result['info']['StatusCode']);
    }

    public function test_non_json_response_is_returned_as_file()
    {
        Http::fake(['*' => Http::response('%PDF-1.4', 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="label.pdf"',
        ])]);

        $result = $this->api()->getResponse('InternetDocument', 'printFull', []);

        $this->assertTrue($result['success']);
        $this->assertTrue($result['info']['file']);
        $this->assertSame('application/pdf', $result['info']['ContentType']);
        $this->assertSame('%PDF-1.4', $result['result']);
    }

    public function test_api_key_from_config_is_sent_in_body()
    {
        Http::fake(['*' => $this->okResponse()]);

        $this->api()->getResponse('Address', 'getCities', []);

        $this->assertSame('test-key', $this->sentBody()['apiKey']);
    }

    public function test_setApi_overrides_configured_key()
    {
        Http::fake(['*' => $this->okResponse()]);

        $this->api()->setApi('other-key')->getResponse('Address', 'getCities', []);

        $this->assertSame('other-key', $this->sentBody()['apiKey']);
    }

    public function test_auth_false_unwraps_first_element_and_omits_key()
    {
        Http::fake(['*' => Http::response([
            ['success' => true, 'data' => [['Ref' => 'x']]],
        ], 200, ['Content-Type' => 'application/json'])]);

        $result = $this->api()->getResponse('Address', 'getCities', [], false);

        $this->assertTrue($result['success']);
        $this->assertSame([['Ref' => 'x']], $result['result']);
        $this->assertArrayNotHasKey('apiKey', $this->sentBody());
    }

    public function test_setOtherParams_is_merged_into_body()
    {
        Http::fake(['*' => $this->okResponse()]);

        $this->api()->setOtherParams(['Extra' => 1])->getResponse('Address', 'getCities', []);

        $this->assertSame(1, $this->sentBody()['Extra']);
    }

    public function test_dev_mode_adds_raw_answer_to_result()
    {
        $this->app['config']->set('novaposhta.dev', true);
        Http::fake(['*' => $this->okResponse([['Ref' => 'd']])]);

        $result = $this->api()->getResponse('Address', 'getCities', []);

        $this->assertArrayHasKey('dev', $result);
        $this->assertSame([['Ref' => 'd']], $result['dev']['data']);
    }

    public function test_addInfo_collects_warnings_and_info_codes()
    {
        $info = $this->api()->addInfo([
            'warnings' => ['w1'],
            'infoCodes' => ['100'],
            'info' => ['i1'],
        ]);

        $this->assertSame(['w1'], $info['warnings']);
        $this->assertSame(['100'], $info['infoCodes']);
        $this->assertSame(['i1'], $info['info']);
        $this->assertArrayHasKey('StatusLocale', $info);
    }

    public function test_addInfo_takes_status_code_from_first_error()
    {
        $info = $this->api()->addInfo([
            'errors' => ['e1', 'e2'],
            'errorCodes' => ['E1', 'E2'],
        ]);

        $this->assertSame(['e1', 'e2'], $info['errors']);
        $this->assertSame('E1', $info['StatusCode']);
        $this->assertArrayHasKey('StatusLocale', $info);
    }

    public function test_addInfo_returns_empty_array_for_empty_answer()
    {
        $this->assertSame([], $this->api()->addInfo([]));
    }

    public function test_result_is_reset_between_calls()
    {
        $api = $this->api();

        // Первый вызов - успех, второй - ошибка. Одна заглушка, чтобы не зависеть от порядка fake().
        $calls = 0;
        Http::fake(['*' => function () use (&$calls) {
            $calls++;

            return $calls === 1
                ? $this->okResponse([1])
                : Http::response([
                    'success' => false,
                    'data' => [],
                    'errors' => ['x'],
                    'errorCodes' => ['1'],
                ], 200, ['Content-Type' => 'application/json']);
        }]);

        $first = $api->getResponse('Address', 'getCities', []);
        $second = $api->getResponse('Address', 'getCities', []);

        $this->assertTrue($first['success']);
        $this->assertSame([1], $first['result']);
        $this->assertFalse($second['success']);
        $this->assertSame([], $second['result']);
        $this->assertSame('1', $second['info']['StatusCode']);
    }
}
