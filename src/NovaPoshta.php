<?php

namespace Daaner\NovaPoshta;

use Daaner\NovaPoshta\Contracts\NovaPoshtaInterface;
use Exception;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshta implements NovaPoshtaInterface
{
    protected $api;
    protected $url;
    protected $dev;

    protected $return;

    protected $model;
    protected $calledMethod;
    protected $methodProperties;

    /**
     * NovaPoshta constructor main settings.
     */
    public function __construct()
    {
        $this->dev = config('novaposhta.dev');
        $this->getApi();
        $this->url = config('novaposhta.base_uri').config('novaposhta.point');

        $this->return = [
            'success' => false,
            'result' => null,
            'info' => [],
        ];
    }

    /**
     * @return void
     */
    public function getApi(): void
    {
        if (! $this->api) {
            $this->api = config('novaposhta.api_key');
        }
    }

    /**
     * Устанавливаем API токен отличный от значения в конфиге.
     *
     * @param  string  $api  API токен
     * @return $this
     */
    public function setApi(string $api): self
    {
        $this->api = $api;

        return $this;
    }

    /**
     * @param  bool  $auth
     * @return ClientResponse|string|array
     */
    public function getData(bool $auth = true)
    {
        $url = $this->url.'/'.$this->model.'/'.$this->calledMethod;

        $body = [];
        $body['modelName'] = $this->model;
        $body['calledMethod'] = $this->calledMethod;
        $body['methodProperties'] = $this->methodProperties;

        if ($auth) {
            $body['apiKey'] = $this->api;
        }

        if ($this->dev) {
            $this->development($auth);
        }

        try {
            $response = Http::timeout(config('novaposhta.http_response_timeout', 3))
                ->retry(
                    config('novaposhta.http_retry_max_time', 2),
                    config('novaposhta.http_retry_delay', 500)
                )
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post($url, $body);
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                // Ошибка API ключа
                $response = __('novaposhta::novaposhta.statusCode.20000200068');
            } else {
                $response = $e->getMessage();
            }
        }

        return $response;
    }

    /**
     * @param  string  $model  Модель Новой Почты
     * @param  string  $calledMethod  Метод модели
     * @param  array|null  $methodProperties  Тело запроса
     * @param  bool  $auth  Использовать ли аутентификацию токеном или нет
     * @return array
     */
    public function getResponse(
        string $model,
        string $calledMethod,
        ?array $methodProperties,
        bool $auth = true
    ): array {
        $this->model = $model;
        $this->calledMethod = $calledMethod;
        $this->methodProperties = $methodProperties;

        $response = $this->getData($auth);

        // Ошибка курла
        if (! ($response instanceof ClientResponse)) {
            $this->return['info']['error'] = $response;
            $this->return['info']['StatusCode'] = '20000100016'; // Сервис не доступен
            $this->return['info']['StatusLocale'] = __('novaposhta::novaposhta.error_data');

            return $this->return;
        }

        // Ошибка запроса или 401
        if ($response->failed()) {
            $this->return['info']['error'] = trans('novaposhta::novaposhta.error_data');

            return $this->return;
        }

        // если что-то не JSON (типа application/pdf)
        if ($response->header('Content-Type') !== 'application/json') {
            $this->return['success'] = $response->ok();

            $this->return['info']['file'] = true;
            $this->return['info']['ContentType'] = $response->header('Content-Type');
            $this->return['info']['ContentDisposition'] = $response->header('Content-Disposition') ?? '';

            $this->return['result'] = $response->body();

            return $this->return;
        }

        $answer = $response->json();

        /**
         * Development.
         */
        if ($this->dev) {
            $this->return['dev'] = $answer;
        }

        // TODO: Возможно, исправлено
        if ($auth === false && isset($answer[0])) {
            /**
             * Костыль для Новой Почты.
             * Спасибо Вам большое, что нормально не выдаете ответ :).
             */
            $answer = $answer[0];
        }

        if (isset($answer['success'])) {
            $this->return['success'] = $answer['success'];
        }

        if (isset($answer['data'])) {
            $this->return['result'] = $answer['data'];
        }

        /**
         * Формирование info.
         */
        $this->return['info'] = $this->addInfo($answer);

        return $this->return;
    }

    /**
     * Формирование информации.
     * Ошибки, уведомления.
     *
     * @param  mixed  $answer  Ответ от НП
     */
    public function addInfo($answer): array
    {
        $info = [];

        if (isset($answer['warnings']) && $answer['warnings']) {
            $info['warnings'] = $answer['warnings'];
        }

        if (isset($answer['infoCodes']) && $answer['infoCodes']) {
            $info['infoCodes'] = $answer['infoCodes'];

            foreach ($answer['infoCodes'] as $err) {
                $info['infoCodes'] = $err;
            }
            if (isset($answer['infoCodes'][0])) {
                $info['StatusLocale'] = __('novaposhta::novaposhta.statusCode.'.$answer['infoCodes'][0]);
            }
        }

        if (isset($answer['errors']) && $answer['errors']) {
            $info['errors'] = $answer['errors'];
            if ($answer['errorCodes']) {
                foreach ($answer['errorCodes'] as $err) {
                    $info['StatusCode'] = $err;
                }
                if (isset($answer['errorCodes'][0])) {
                    $info['StatusLocale'] = __('novaposhta::novaposhta.statusCode.'.$answer['errorCodes'][0]);
                }
            }
        }

        if (isset($answer['info']) && $answer['info']) {
            $info['info'] = $answer['info'];
        }

        return $info;
    }

    /**
     * Логирование запроса.
     *
     * @param  bool  $auth  Аутентификация
     * @return void
     */
    public function development(bool $auth): void
    {
        Log::debug('= = = = = = = = = = = = = = = = = = = =');
        Log::debug($this->model.' / '.$this->calledMethod.' // apiKey: '.(int) $auth);
        Log::debug('--------------------');

        if (! empty($this->methodProperties)) {
            try {
                Log::notice(json_encode($this->methodProperties));
            } catch (Exception $e) {
                Log::notice('method json_encode error');
            }
        }
    }
}
