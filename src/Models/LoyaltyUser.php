<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class LoyaltyUser extends NovaPoshta
{

    protected $model = 'LoyaltyUser';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Не документировано
     *
     * @return array
     */
    public function getLoyaltyInfoByApiKey()
    {
        $this->calledMethod = 'getLoyaltyInfoByApiKey';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

}
