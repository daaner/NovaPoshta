<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class CarCallGeneral extends NovaPoshta
{

    protected $model = 'CarCallGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Получение списка ордеров для заказа авто.
     *
     * @since 2022-11-05 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param bool $extendedInfo Расширенная информация
     * @return array
     */
    public function getOrdersList(bool $extendedInfo = true): array
    {
        $this->calledMethod = 'getOrdersList';

        $this->methodProperties['getExtendedInfo'] = $extendedInfo;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }


}
