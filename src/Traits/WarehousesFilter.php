<?php

namespace Daaner\NovaPoshta\Traits;

trait WarehousesFilter
{
    protected $typeOfWarehouseRef;

    /**
     * Наличие парковки для велосипедов.
     *
     * @return $this
     */
    public function filterBicycleParking(): self
    {
        $this->methodProperties['BicycleParking'] = 1;

        return $this;
    }

    /**
     * Наличие PostFinance.
     *
     * @return $this
     */
    public function filterPostFinance(): self
    {
        $this->methodProperties['PostFinance'] = 1;

        return $this;
    }

    /**
     * Фильтр по типу отделения.
     *
     * @param  string  $typeOfWarehouseRef  Ref типа отделения
     * @return $this
     */
    public function setTypeOfWarehouseRef(string $typeOfWarehouseRef): self
    {
        $this->typeOfWarehouseRef = $typeOfWarehouseRef;

        return $this;
    }

    /**
     * @return void
     */
    public function getTypeOfWarehouseRef(): void
    {
        if ($this->typeOfWarehouseRef) {
            $this->methodProperties['TypeOfWarehouseRef'] = $this->typeOfWarehouseRef;
        }
    }
}
