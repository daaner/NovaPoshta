<?php

namespace Daaner\NovaPoshta\Traits;

trait CounterpartyProperty
{
    protected $counterpartyType;
    protected $counterpartyProperty;
    protected $ownershipForm;
    protected $EDRPOU;

    /**
     * Установка типа контрагента.
     *
     * @param  string  $counterpartyType  Тип контрагента (PrivatePerson)
     * @return $this
     */
    public function setCounterpartyType(string $counterpartyType): self
    {
        $this->counterpartyType = $counterpartyType;

        return $this;
    }

    /**
     * Установка свойства контрагента.
     *
     * @param  string  $counterpartyProperty  Свойства контрагента (Recipient / Sender)
     * @return $this
     */
    public function setCounterpartyProperty(string $counterpartyProperty): self
    {
        $this->counterpartyProperty = $counterpartyProperty;

        return $this;
    }

    /**
     * Установка формы собственности.
     *
     * @param  string  $ownershipForm  Ref формы собственности
     * @return $this
     */
    public function setOwnershipForm(string $ownershipForm): self
    {
        $this->ownershipForm = $ownershipForm;

        return $this;
    }

    /**
     * Установка ЕДРПОУ.
     *
     * @param  string  $EDRPOU  ЕРДПОУ
     * @return $this
     */
    public function setEDRPOU(string $EDRPOU): self
    {
        $this->EDRPOU = $EDRPOU;

        return $this;
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
     * Вынесенная логика для удаления контактов
     * используется для создания / изменения данных организаций или третьих лиц.
     *
     * @deprecated НЕ СДЕЛАНО, сложно проверить
     *
     * TODO Не сделано
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
