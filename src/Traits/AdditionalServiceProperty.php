<?php

namespace Daaner\NovaPoshta\Traits;

trait AdditionalServiceProperty
{
    protected $Reason;
    protected $SubtypeReason;
    protected $ReturnAddressRef;
    protected $RecipientWarehouse;
    protected $RecipientSettlement;

    /**
     * @return void
     */
    public function getReason(): void
    {
        $this->methodProperties['Reason'] = $this->Reason ?: config('novaposhta.ref_return_reasons');
    }

    /**
     * Устанавливаем идентификатор причины возврата.
     *
     * @param  string  $Reason
     * @return void
     */
    public function setReason(string $Reason): void
    {
        $this->Reason = $Reason;
    }

    /**
     * @return void
     */
    public function getSubtypeReason(): void
    {
        $this->methodProperties['SubtypeReason'] = $this->SubtypeReason ?: config('novaposhta.ref_return_reasons_sub');
    }

    /**
     * Устанавливаем идентификатор причины суб возврата.
     *
     * @param  string  $SubtypeReason
     * @return void
     */
    public function setSubtypeReason(string $SubtypeReason): void
    {
        $this->SubtypeReason = $SubtypeReason;
    }

    /**
     * @return void
     */
    public function getReturnAddressRef(): void
    {
        if ($this->ReturnAddressRef) {
            $this->methodProperties['ReturnAddressRef'] = $this->ReturnAddressRef;
        }
    }

    /**
     * Устанавливаем идентификатор адреса возврата.
     * Значение из метода CheckPossibilityCreateReturn!!!
     *
     * @param  string  $ReturnAddressRef
     * @return void
     */
    public function setReturnAddressRef(string $ReturnAddressRef): void
    {
        $this->ReturnAddressRef = $ReturnAddressRef;

        // Очищаем данные предыдущих значений по возврату
        $this->RecipientWarehouse = null;
        $this->RecipientSettlement = null;
    }

    /**
     * @return void
     */
    public function getRecipientWarehouse(): void
    {
        if ($this->RecipientWarehouse) {
            $this->methodProperties['RecipientWarehouse'] = $this->RecipientWarehouse;
        }

        //Если другие идентификаторы не заполнены - оформляем возврат на отделение по умолчанию (из конфига)
        if (! $this->ReturnAddressRef && ! $this->RecipientWarehouse && ! $this->RecipientSettlement) {
            $this->methodProperties['RecipientWarehouse'] = config('novaposhta.ref_return_warehouse');
        }
    }

    /**
     * Устанавливаем идентификатор возврата на новое отделение.
     *
     * @param  string  $RecipientWarehouse
     * @return void
     */
    public function setRecipientWarehouse(string $RecipientWarehouse): void
    {
        $this->RecipientWarehouse = $RecipientWarehouse;

        // Очищаем данные предыдущих значений по возврату
        $this->ReturnAddressRef = null;
        $this->RecipientSettlement = null;
    }

    /**
     * @return void
     */
    public function getRecipientSettlement(): void
    {
        if ($this->RecipientSettlement) {
            $this->methodProperties['RecipientSettlement'] = $this->RecipientSettlement['settlement'] ?? '';
            $this->methodProperties['RecipientSettlementStreet'] = $this->RecipientSettlement['street'] ?? '';
            $this->methodProperties['BuildingNumber'] = $this->RecipientSettlement['building'] ?? '';
            $this->methodProperties['NoteAddressRecipient'] = $this->RecipientSettlement['other'] ?? '';
        }
    }

    /**
     * Устанавливаем идентификатор возврата на новое отделение.
     *
     * @param  array  $RecipientSettlement
     * @return void
     */
    public function setRecipientSettlement(array $RecipientSettlement): void
    {
        $this->RecipientSettlement = $RecipientSettlement;

        // Очищаем данные предыдущих значений по возврату
        $this->ReturnAddressRef = null;
        $this->RecipientWarehouse = null;
    }
}
