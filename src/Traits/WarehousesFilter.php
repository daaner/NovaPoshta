<?php

namespace Daaner\NovaPoshta\Traits;

trait WarehousesFilter
{
    protected $typeOfWarehouseRef;

    /**
     * Наличие парковки для велосипедов.
     *
     * @return void
     */
    public function filterBicycleParking(): void
    {
        $this->methodProperties['BicycleParking'] = 1;
    }

    /**
     * Наличие PostFinance.
     *
     * @return void
     */
    public function filterPostFinance(): void
    {
        $this->methodProperties['PostFinance'] = 1;
    }

    /**
     * Фильтр по типу отделения.
     *
     * @param  string  $typeOfWarehouseRef  Ref типа отделения
     * @return void
     */
    public function setTypeOfWarehouseRef(string $typeOfWarehouseRef): void
    {
        $this->typeOfWarehouseRef = $typeOfWarehouseRef;
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
