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
      $this->url = $this->baseUri . $this->point;
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
     * @param array $data
     * @param bool $auth
     * @return array
     */
    public function getResponse($model, $calledMethod, $data, $auth = true)
    {
      $url = $this->url . '/' . $model . '/' . $calledMethod;
      $body = array();

      if ($auth) {
        $body = [
          'apiKey' => $this->api,
          'modelName' => $model,
          'calledMethod' => $calledMethod,
          'methodProperties' => $data,
        ];
      } else {
        array_push($body, [
          'modelName' => $model,
          'calledMethod' => $calledMethod,
          'methodProperties' => $data,
        ]);
      }

      $response = Http::timeout(3)
        ->retry(2, 200)
        ->withHeaders([
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
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
      if (!$auth && isset($answer[0])) {
        //костыль для НовойПочты. Спасибо Вам большое :)
        $answer = $answer[0];
      }

      if (!isset($answer['success']) || !isset($answer['data']) || empty($answer['data'])) {
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
          $info = array();
          foreach ($answer['errorCodes'] as $key => $err) {
            array_push($info, [
              'StatusCode' => $err,
              'StatusLocale' => __('novaposhta::novaposhta.statusCode.' . $err),
            ]);
          }
        }
      } else {
        $info = $answer['warnings'];
      }

      if (!$info) {
        $info = $answer['info'];
      }

      $return = [
        'success' => $success,
        'result' => $result,
        'info' => $info,
      ];

      if ($this->dev) {
        $return['dev'] = $answer;
      }

      return $return;
    }
}
