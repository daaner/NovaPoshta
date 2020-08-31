<?php

namespace Daaner\NovaPoshta\Traits;

trait WarehousesFilter
{
    protected $typeOfWarehouseRef;

    /**
     * @return this
     */
    public function filterBicycleParking()
    {
        $this->methodProperties['BicycleParking'] = 1;

        return $this;
    }

    /**
     * @return this
     */
    public function filterPostFinance()
    {
        $this->methodProperties['PostFinance'] = 1;

        return $this;
    }

    /**
     * @param string $typeOfWarehouseRef
     * @return this
     */
    public function setTypeOfWarehouseRef($typeOfWarehouseRef)
    {
        $this->typeOfWarehouseRef = $typeOfWarehouseRef;

        return $this;
    }

    /**
     * @return this
     */
    public function getTypeOfWarehouseRef()
    {
        if ($this->typeOfWarehouseRef) {
            $this->methodProperties['TypeOfWarehouseRef'] = $this->typeOfWarehouseRef;
        }

        return $this;
    }
}
