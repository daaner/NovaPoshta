<?php

namespace Daaner\NovaPoshta\Traits;

trait CounterpartyProperty
{
    protected $counterpartyType;
    protected $counterpartyProperty;
    protected $ownershipForm;
    protected $EDRPOU;

    /**
     * @param  string  $counterpartyType
     * @return $this
     */
    public function setCounterpartyType(string $counterpartyType)
    {
        $this->counterpartyType = $counterpartyType;

        return $this;
    }

    /**
     * @param  string  $counterpartyProperty
     * @return $this
     */
    public function setCounterpartyProperty(string $counterpartyProperty)
    {
        $this->counterpartyProperty = $counterpartyProperty;

        return $this;
    }

    /**
     * @param  string  $ownershipForm
     * @return $this
     */
    public function setOwnershipForm(string $ownershipForm)
    {
        $this->ownershipForm = $ownershipForm;

        return $this;
    }

    /**
     * @param  string  $EDRPOU
     * @return $this
     */
    public function setEDRPOU(string $EDRPOU)
    {
        $this->EDRPOU = $EDRPOU;

        return $this;
    }

    /**
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * TODO: Проверить сложно.
     * Вынесенная логика для удаления контактов
     * используется для создания / изменения данных организаций или третьих лиц.
     *
     * @return $this
     */
    public function makeOrganization()
    {
        //need clear data
        $lastName = '';
        // $middleName = '';
        // $phone = '';
        // $email = '';

        return $this;
    }
}
