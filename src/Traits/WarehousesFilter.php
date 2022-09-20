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
    public function filterBicycleParking()
    {
        $this->methodProperties['BicycleParking'] = 1;

        return $this;
    }

    /**
     * Наличие PostFinance.
     *
     * @return $this
     */
    public function filterPostFinance()
    {
        $this->methodProperties['PostFinance'] = 1;

        return $this;
    }

    /**
     * @param string $typeOfWarehouseRef
     * @return $this
     */
    public function setTypeOfWarehouseRef(string $typeOfWarehouseRef)
    {
        $this->typeOfWarehouseRef = $typeOfWarehouseRef;

        return $this;
    }

    /**
     * @return $this
     */
    public function getTypeOfWarehouseRef()
    {
        if ($this->typeOfWarehouseRef) {
            $this->methodProperties['TypeOfWarehouseRef'] = $this->typeOfWarehouseRef;
        }

        return $this;
    }
}
