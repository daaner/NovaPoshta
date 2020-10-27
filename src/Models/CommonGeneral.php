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

    // не работает, требует JWT авторизацию
    public function prolongateKey($ApiKey, $month = 12)
    {
        $this->calledMethod = 'prolongateApiKey';

        $this->methodProperties['ApiKey'] = $ApiKey;
        $this->methodProperties['prolongateMounthCount'] = $month;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
