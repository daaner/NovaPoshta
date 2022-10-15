<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class CommonGeneral extends NovaPoshta
{
    protected $model = 'CommonGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Список ошибок.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1 Список ошибок
     *
     * @return array
     */
    public function getMessageCodeText(): array
    {
        $this->calledMethod = 'getMessageCodeText';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Продление даты действия API ключа.
     *
     * @deprecated Не работает, требует JWT авторизацию
     *
     * @param  string  $ApiKey API токен
     * @param  int|null  $month Кол-во месяцев продления
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
