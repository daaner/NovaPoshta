<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class CommonGeneral extends NovaPoshta
{
    protected $model = 'CommonGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Перелік помилок.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1
     *
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
