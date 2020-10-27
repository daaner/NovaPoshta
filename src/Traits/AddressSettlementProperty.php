<?php

namespace Daaner\NovaPoshta\Traits;

trait AddressSettlementProperty
{
    protected $AreaRef;
    protected $RegionRef;
    protected $Ref;
    protected $Warehouse = false;

    /**
     * @param string $AreaRef
     * @return this
     */
    public function filterAreaRef($AreaRef)
    {
        $this->AreaRef = $AreaRef;

        return $this;
    }

    /**
     * @return this
     */
    public function getAreaRef()
    {
        if ($this->AreaRef) {
            $this->methodProperties['AreaRef'] = $this->AreaRef;
        }

        return $this;
    }

    /**
     * @param string $RegionRef
     * @return this
     */
    public function filterRegionRef($RegionRef)
    {
        $this->RegionRef = $RegionRef;

        return $this;
    }

    /**
     * @return this
     */
    public function getRegionRef()
    {
        if ($this->RegionRef) {
            $this->methodProperties['RegionRef'] = $this->RegionRef;
        }

        return $this;
    }

    /**
     * @return this
     */
    public function filterWarehouse()
    {
        $this->Warehouse = true;

        return $this;
    }

    /**
     * @return this
     */
    public function getWarehouse()
    {
        if ($this->Warehouse) {
            $this->methodProperties['Warehouse'] = 1;
        }

        return $this;
    }

    /**
     * @param string $ref
     * @return this
     */
    public function filterRef($ref)
    {
        $this->Ref = $ref;

        return $this;
    }

    /**
     * @return this
     */
    public function getRef()
    {
        if ($this->Ref) {
            $this->methodProperties['Ref'] = $this->Ref;
        }

        return $this;
    }
}
