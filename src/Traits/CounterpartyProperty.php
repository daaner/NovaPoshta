<?php

namespace Daaner\NovaPoshta\Traits;

trait CounterpartyProperty
{
    protected $counterpartyType;
    protected $counterpartyProperty;
    protected $ownershipForm;
    protected $EDRPOU;

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
    public function setOwnershipForm($ownershipForm)
    {
        $this->ownershipForm = $ownershipForm;

        return $this;
    }

    /**
     * @return this
     */
    public function setEDRPOU($EDRPOU)
    {
        $this->EDRPOU = $EDRPOU;

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
        //Сделано для getCounterpartyAddresses,
        //однако этот справочник игнорирует СounterpartyProperty в поиске
        if ($this->counterpartyProperty == 'All') {
            return $this;
        }

        if (! $this->counterpartyProperty) {
            $this->counterpartyProperty = 'Recipient';
        }

        $this->methodProperties['CounterpartyProperty'] = $this->counterpartyProperty;

        return $this;
    }

    /**
     * @return this
     */
    public function getOwnershipForm()
    {
        if ($this->ownershipForm) {
            $this->methodProperties['OwnershipForm'] = $this->ownershipForm;
            $this->methodProperties['CounterpartyType'] = 'Organization';
            $this->makeOrganization();
        }

        return $this;
    }

    /**
     * @return this
     */
    public function getEDRPOU()
    {
        if ($this->EDRPOU) {
            $this->methodProperties['EDRPOU'] = $this->EDRPOU;
            $this->methodProperties['CounterpartyProperty'] = 'ThirdPerson';
            $this->makeOrganization();
        }

        return $this;
    }

    /**
     * Вынесенная логика для удаления контактов
     * используется для создания / изменения данных организаций или третьих лиц.
     * @return this
     */
    public function makeOrganization()
    {
        $lastName = '';
        $middleName = '';
        $phone = '';
        $email = '';

        return $this;
    }
}
