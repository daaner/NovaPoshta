<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class Payment extends NovaPoshta
{
    protected $model = 'Payment';
    protected $calledMethod;
    protected $methodProperties = null;

    /***
     * Получение данных по картам оплаты.
     *
     * @since 2022-11-07
     *
     * @return array
     */
    public function walletManagement(): array
    {
        $this->calledMethod = 'walletManagement';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
