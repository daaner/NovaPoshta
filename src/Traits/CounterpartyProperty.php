<?php

namespace Daaner\NovaPoshta\Traits;

trait CounterpartyProperty
{
    protected $counterpartyType;
    protected $counterpartyProperty;
    protected $ownershipForm;
    protected $EDRPOU;

    /**
     * @param  string  $counterpartyType Тип контрагента (PrivatePerson)
     * @return void
     */
    public function setCounterpartyType(string $counterpartyType): void
    {
        $this->counterpartyType = $counterpartyType;
    }

    /**
     * @param  string  $counterpartyProperty Свойства контрагента (Recipient / Sender)
     * @return void
     */
    public function setCounterpartyProperty(string $counterpartyProperty): void
    {
        $this->counterpartyProperty = $counterpartyProperty;
    }

    /**
     * @param  string  $ownershipForm Ref формы собственности
     * @return void
     */
    public function setOwnershipForm(string $ownershipForm): void
    {
        $this->ownershipForm = $ownershipForm;
    }

    /**
     * @param  string  $EDRPOU ЕРДПОУ
     * @return void
     */
    public function setEDRPOU(string $EDRPOU): void
    {
        $this->EDRPOU = $EDRPOU;
    }

    /**
     * @return void
     */
    public function getCounterpartyType(): void
    {
        if (! $this->counterpartyType) {
            $this->counterpartyType = 'PrivatePerson';
        }

        $this->methodProperties['CounterpartyType'] = $this->counterpartyType;
    }

    /**
     * @return void
     */
    public function getCounterpartyProperty(): void
    {
        //Сделано для getCounterpartyAddresses,
        //однако этот справочник игнорирует СounterpartyProperty в поиске
        if ($this->counterpartyProperty == 'All') {
            return;
        }

        if (! $this->counterpartyProperty) {
            $this->counterpartyProperty = 'Recipient';
        }

        $this->methodProperties['CounterpartyProperty'] = $this->counterpartyProperty;
    }

    /**
     * @return void
     */
    public function getOwnershipForm(): void
    {
        if ($this->ownershipForm) {
            $this->methodProperties['OwnershipForm'] = $this->ownershipForm;
            $this->methodProperties['CounterpartyType'] = 'Organization';
            $this->makeOrganization();
        }
    }

    /**
     * @return void
     */
    public function getEDRPOU(): void
    {
        if ($this->EDRPOU) {
            $this->methodProperties['EDRPOU'] = $this->EDRPOU;
            $this->methodProperties['CounterpartyProperty'] = 'ThirdPerson';
            $this->makeOrganization();
        }
    }

    /**
     * TODO Не тестировалось.
     * Вынесенная логика для удаления контактов
     * используется для создания / изменения данных организаций или третьих лиц.
     *
     * @return void
     */
    public function makeOrganization(): void
    {
        //need clear data
        // $lastName = '';
        // $middleName = '';
        // $phone = '';
        // $email = '';
    }
}
