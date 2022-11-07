<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;

class CommonGeneral extends NovaPoshta
{
    use Limit;

    protected $model = 'CommonGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Список ошибок.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1 Список ошибок
     * @since 2022-11-03
     *
     * @return array
     */
    public function getMessageCodeText(): array
    {
        $this->calledMethod = 'getMessageCodeText';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Продление даты действия API ключа.
     *
     * @since 2022-11-03
     *
     * @param  string  $ApiKey  API ключ
     * @param  int|null  $month  Кол-во месяцев продления
     * @return array
     */
    public function prolongateKey(string $ApiKey, ?int $month = 12): array
    {
        $this->calledMethod = 'prolongateApiKey';

        $this->methodProperties['ApiKey'] = $ApiKey;
        $this->methodProperties['prolongateMounthCount'] = $month;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение списка API ключей.
     *
     * @since 2022-11-03
     *
     * @return array
     */
    public function getApiKeysList(): array
    {
        $this->calledMethod = 'getApiKeysList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение доверенных устройств.
     *
     * @since 2022-11-03
     *
     * @return array
     */
    public function getTrustedDevicesList(): array
    {
        $this->calledMethod = 'getTrustedDevicesList';

        $this->getLimit();
        $this->getPage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Удаление доверенного устройства со списка.
     *
     * @since 2022-11-03
     *
     * @param  string  $Ref  Ref устройства
     * @return array
     */
    public function deleteTrustedDevice(string $Ref): array
    {
        $this->calledMethod = 'deleteTrustedDevice';

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Создание API ключа.
     *
     * @since 2022-11-07 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string|null  $MarketplacePartnerToken
     * @return array
     */
    public function createApiKey(?string $MarketplacePartnerToken = null): array
    {
        $this->calledMethod = 'createApiKey';

        if ($MarketplacePartnerToken) {
            $this->methodProperties['MarketplacePartnerToken'] = $MarketplacePartnerToken;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Удаление API ключа.
     *
     * @since 2022-11-07 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string  $ApiKey
     * @return array
     */
    public function deleteApiKey(string $ApiKey): array
    {
        $this->calledMethod = 'deleteApiKey';

        $this->methodProperties['ApiKey'] = $ApiKey;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
