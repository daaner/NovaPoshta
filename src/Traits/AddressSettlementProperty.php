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
     * @return $this
     */
    public function filterAreaRef(string $AreaRef): self
    {
        $this->AreaRef = $AreaRef;

        return $this;
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
     * @return $this
     */
    public function filterRegionRef(string $RegionRef): self
    {
        $this->RegionRef = $RegionRef;

        return $this;
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
     * @return $this
     */
    public function filterWarehouse(): self
    {
        $this->Warehouse = true;

        return $this;
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
     * @return $this
     */
    public function filterRef(string $ref): self
    {
        $this->Ref = $ref;

        return $this;
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
