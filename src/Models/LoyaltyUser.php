<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;

class LoyaltyUser extends NovaPoshta
{
    use Limit;

    protected $model = 'LoyaltyUser';
    protected $calledMethod;
    protected $methodProperties = null;

    /***
     * Получение данных по бонусной карте.
     *
     * @see https://daaner.github.io/NovaPoshta/#/LoyaltyUser?id=getloyaltyinfobyapikey НЕ ДОКУМЕНТИРОВАНО
     * @since 2022-11-06
     *
     * @return array
     */
    public function getLoyaltyInfoByApiKey(): array
    {
        $this->calledMethod = 'getLoyaltyInfoByApiKey';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение данных о входящих посылках.
     *
     * @since 2022-11-05
     *
     * @param  string|null  $Year  Год (в формате YYYY)
     * @param  string|null  $Month  Месяц (в формате m)
     * @return array
     */
    public function getLoyaltyCardTurnoverByApiKey(?string $Year = null, ?string $Month = null): array
    {
        $this->calledMethod = 'getLoyaltyCardTurnoverByApiKey';

        if ($Year) {
            $this->methodProperties['Year'] = $Year;
        }

        if ($Month) {
            $this->methodProperties['Month'] = $Month;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение активных промокодов прикрепленных к телефону контрагента.
     *
     * @since 2022-11-06
     *
     * @param  string  $Phone  Телефон контрагента
     * @return array
     */
    public function getPromocodeByPhone(string $Phone): array
    {
        $this->calledMethod = 'getPromocodeByPhone';

        $this->methodProperties['Phone'] = $Phone;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Список по бонусной программе контрагента.
     *
     * @since 2022-11-06
     *
     * @param  string  $CounterpartyRef  Ref контрагента
     * @return array
     */
    public function getStandartCardsList(string $CounterpartyRef): array
    {
        $this->calledMethod = 'getStandartCardsList';

        $this->methodProperties['CounterpartyRef'] = $CounterpartyRef;

        $this->getLimit();
        $this->getPage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
