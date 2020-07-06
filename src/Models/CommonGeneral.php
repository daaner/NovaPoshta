<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class CommonGeneral extends NovaPoshta
{
    protected $model = 'CommonGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    public function getMessageCodeText()
    {
        $this->calledMethod = 'getMessageCodeText';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
