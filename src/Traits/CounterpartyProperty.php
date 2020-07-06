<?php

namespace Daaner\NovaPoshta\Traits;

trait CounterpartyProperty
{
    protected $counterpartyType;
    protected $counterpartyProperty;

    /**
     * @return this
     */
    public function setCounterpartyType($counterpartyType)
    {
        $this->counterpartyType = $counterpartyType;

        return $this;
    }

    /**
     * @return this
     */
    public function setCounterpartyProperty($counterpartyProperty)
    {
        $this->counterpartyProperty = $counterpartyProperty;

        return $this;
    }

    /**
     * @return this
     */
    public function getCounterpartyType()
    {
        if (! $this->counterpartyType) {
            $this->counterpartyType = 'PrivatePerson';
        }

        $this->methodProperties['CounterpartyType'] = $this->counterpartyType;

        return $this;
    }

    /**
     * @return this
     */
    public function getCounterpartyProperty()
    {
        if (! $this->counterpartyProperty) {
            $this->counterpartyProperty = 'Recipient';
        }

        $this->methodProperties['CounterpartyProperty'] = $this->counterpartyProperty;

        return $this;
    }
}
