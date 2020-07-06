<?php

namespace Daaner\NovaPoshta;

use Daaner\NovaPoshta\Contracts\NovaPoshtaInterface;
use Illuminate\Support\Facades\Http;

class NovaPoshta implements NovaPoshtaInterface
{
    protected $baseUri;
    protected $point;

    protected $api;
    protected $url;
    protected $dev;

    /**
     * NovaPoshta constructor main settings.
     */
    public function __construct()
    {
        $this->baseUri = config('novaposhta.base_uri');
        $this->point = config('novaposhta.point');
        $this->dev = config('novaposhta.dev');
        $this->getApi();
        $this->url = $this->baseUri.$this->point;
    }

    /**
     * @return string
     */
    public function getApi()
    {
        if (is_null($this->api)) {
            $this->api = config('novaposhta.api_key');
        }

        return $this->api;
    }

    /**
     * @param string $api
     */
    public function setApi($api)
    {
        $this->api = $api;
    }

    /**
     * @param string $model
     * @param string $calledMethod
     * @param array $methodProperties
     * @param bool $auth
     * @return array
     */
    public function getResponse($model, $calledMethod, $methodProperties, $auth = true)
    {
        $url = $this->url.'/'.$model.'/'.$calledMethod;
        $body = [];

        if ($auth) {
            $body = [
                'apiKey' => $this->api,
                'modelName' => $model,
                'calledMethod' => $calledMethod,
                'methodProperties' => $methodProperties,
            ];
        } else {
            $body['modelName'] = $model;
            $body['calledMethod'] = $calledMethod;
            $body['methodProperties'] = $methodProperties;
        }

        $response = Http::timeout(3)
        ->retry(2, 200)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
        ->post($url, $body);

        if ($response->failed()) {
            return [
                'success' => false,
                'result' => null,
                'info' => __('novaposhta::novaposhta.error_data'),
            ];
        }

        $answer = $response->json();
        if (! $auth && isset($answer[0])) {
            //костыль для НовойПочты. Спасибо Вам большое :)
            $answer = $answer[0];
        }

        if (! isset($answer['success']) || ! isset($answer['data']) || empty($answer['data'])) {
            // что-то не так в ответе
            $info = __('novaposhta::novaposhta.error_answer');
            $success = false;
            $result = null;
        } else {
            $success = $answer['success'];
            $result = $answer['data'];
        }

        // ошибки либо уведомления
        if ($answer['errors']) {
            $info = $answer['errors'];
            if ($answer['errorCodes']) {
                $info = [];
                foreach ($answer['errorCodes'] as $key => $err) {
                    $info['StatusCode'] = $err;
                    $info['StatusLocale'] = __('novaposhta::novaposhta.statusCode.'.$err);
                }
            }
        } else {
            $info = $answer['warnings'];
        }

        if (! $info) {
            $info = $answer['info'];
        }

        $return = [
            'success' => $success,
            'result' => $result,
            'info' => $info,
        ];

        if ($this->dev) {
            //test and dev
            dump($model.' / '.$calledMethod, $methodProperties);

            $return['dev'] = $answer;
        }

        return $return;
    }
}
