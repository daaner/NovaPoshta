<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;


class AdditionalService extends NovaPoshta
{

    protected $model = 'AdditionalService';
    protected $calledMethod;
    protected $methodProperties = [];

    /**
     * Проверка возможности создания заявки на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ttn
     * @return array
     */
    public function CheckPossibilityCreateReturn(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityCreateReturn';
        $this->methodProperties['Number'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка причин возврата.
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7a6bacb-8512-11ec-8ced-005056b2dbe1
     *
     * @return array
     */
    public function getReturnReasons(): array
    {
        $this->calledMethod = 'getReturnReasons';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка подтипов причины возврата.
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1
     *
     * @param string|null $ref
     * @return array
     */
    public function getReturnReasonsSubtypes(?string $ref = null): array
    {
        $this->calledMethod = 'getReturnReasonsSubtypes';
        $this->methodProperties['ReasonRef'] = $ref ?: config('novaposhta.ref_return_reasons');

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка заявок на возврат.
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1
     *
     * @return array
     */
    public function getReturnOrdersList(): array
    {
        $this->calledMethod = 'getReturnOrdersList';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }


}
