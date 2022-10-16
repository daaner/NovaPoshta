<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class LoyaltyUser extends NovaPoshta
{
    protected $model = 'LoyaltyUser';
    protected $calledMethod;
    protected $methodProperties = null;

    /***
     * Получение данных по бонусной карте.
     * Работает на 2022-10-16.
     *
     * @see https://daaner.github.io/NovaPoshta/#/LoyaltyUser?id=getloyaltyinfobyapikey НЕ ДОКУМЕНТИРОВАНО
     *
     * @return array
     */
    public function getLoyaltyInfoByApiKey(): array
    {
        $this->calledMethod = 'getLoyaltyInfoByApiKey';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
