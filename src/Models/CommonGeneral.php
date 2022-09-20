<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class CommonGeneral extends NovaPoshta
{
    protected $model = 'CommonGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * @return array
     */
    public function getMessageCodeText(): array
    {
        $this->calledMethod = 'getMessageCodeText';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Пока еще не работает, требует JWT авторизацию.
     *
     * @param  string  $ApiKey
     * @param  int|null  $month
     * @return array
     */
    public function prolongateKey(string $ApiKey, ?int $month = 12): array
    {
        $this->calledMethod = 'prolongateApiKey';

        $this->methodProperties['ApiKey'] = $ApiKey;
        $this->methodProperties['prolongateMounthCount'] = $month;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
