<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;

class InventoryGeneral extends NovaPoshta
{
    use Limit;

    protected $model = 'InventoryGeneral';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Получение списка доступных к заказу материальных ценностей.
     *
     * @since 2022-11-05
     *
     * @return array
     */
    public function getInventoryNomenclaturesList(): array
    {
        $this->calledMethod = 'getInventoryNomenclaturesList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /***
     * Получение списка заказанных материальных ценностей.
     *
     * @since 2022-11-05
     *
     * @param string|null $Ref Ref контрагента
     * @return array
     */
    public function getInventoryOrdersList(?string $Ref = null): array
    {
        $this->calledMethod = 'getInventoryOrdersList';

        if ($Ref) {
            $this->methodProperties['Ref'] = $Ref;
        }

        $this->getLimit();
        $this->getPage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
