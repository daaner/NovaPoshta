<?php

namespace Daaner\NovaPoshta\Tests;

use Daaner\NovaPoshta\Facades\NovaPoshta as NovaPoshtaFacade;
use Daaner\NovaPoshta\NovaPoshtaServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [NovaPoshtaServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return ['NovaPoshta' => NovaPoshtaFacade::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('novaposhta.api_key', 'test-key');
        $app['config']->set('novaposhta.base_uri', 'https://api.novaposhta.test/v2.0/');
        $app['config']->set('novaposhta.point', 'json');
        $app['config']->set('novaposhta.dev', false);
        $app['config']->set('novaposhta.http_response_timeout', 1);
        $app['config']->set('novaposhta.http_retry_max_time', 1);
        $app['config']->set('novaposhta.http_retry_delay', 0);
    }

    /**
     * Успешный JSON-ответ НП.
     */
    protected function okResponse(array $data = [], bool $success = true)
    {
        return Http::response([
            'success' => $success,
            'data' => $data,
            'errors' => [],
            'warnings' => [],
            'info' => [],
            'infoCodes' => [],
        ], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Тело последнего отправленного запроса.
     */
    protected function sentBody(): array
    {
        $body = [];
        Http::assertSent(function ($request) use (&$body) {
            $body = $request->data();

            return true;
        });

        return $body;
    }

    /**
     * Проверяет, что ушёл запрос к нужной модели и методу и что apiKey есть / нет.
     */
    protected function assertApiRequest(string $model, string $calledMethod, bool $withKey): void
    {
        Http::assertSent(function ($request) use ($model, $calledMethod, $withKey) {
            $body = $request->data();

            return ($body['modelName'] ?? null) === $model
                && ($body['calledMethod'] ?? null) === $calledMethod
                && array_key_exists('apiKey', $body) === $withKey;
        });
    }
}
