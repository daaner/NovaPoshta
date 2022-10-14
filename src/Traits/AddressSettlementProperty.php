<?php

namespace Daaner\NovaPoshta\Traits;

trait AddressSettlementProperty
{
    protected $AreaRef;
    protected $RegionRef;
    protected $Ref;
    protected $Warehouse = false;

    /**
     * Фильтровать по области.
     *
     * @param  string  $AreaRef  Ref области
     * @return void
     */
    public function filterAreaRef(string $AreaRef): void
    {
        $this->AreaRef = $AreaRef;
    }

    /**
     * @return void
     */
    public function getAreaRef(): void
    {
        if ($this->AreaRef) {
            $this->methodProperties['AreaRef'] = $this->AreaRef;
        }
    }

    /**
     * Фильтровать по региону.
     *
     * @param  string  $RegionRef  Ref региона
     * @return void
     */
    public function filterRegionRef(string $RegionRef): void
    {
        $this->RegionRef = $RegionRef;
    }

    /**
     * @return void
     */
    public function getRegionRef(): void
    {
        if ($this->RegionRef) {
            $this->methodProperties['RegionRef'] = $this->RegionRef;
        }
    }

    /**
     * Фильтровать по наличию отделений.
     *
     * @return void
     */
    public function filterWarehouse(): void
    {
        $this->Warehouse = true;
    }

    /**
     * @return void
     */
    public function getWarehouse(): void
    {
        if ($this->Warehouse) {
            $this->methodProperties['Warehouse'] = 1;
        }
    }

    /**
     * Фильтровать по Ref.
     *
     * @param  string  $ref  Ref фильтра
     * @return void
     */
    public function filterRef(string $ref): void
    {
        $this->Ref = $ref;
    }

    /**
     * @return void
     */
    public function getRef(): void
    {
        if ($this->Ref) {
            $this->methodProperties['Ref'] = $this->Ref;
        }
    }
}
