<?php

namespace Daaner\NovaPoshta\Traits;

trait AdditionalServiceProperty
{
    protected $Reason;
    protected $SubtypeReason;
    protected $ReturnAddressRef;
    protected $RecipientWarehouse;
    protected $RecipientSettlement;
    protected $Number;
    protected $Customer;
    protected $RecipientData;

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
     * @param  string  $Reason  Ref возврата
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
     * Устанавливаем идентификатор подтипа причины возврата.
     *
     * @param  string  $SubtypeReason  Ref подтипа возврата
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
     * @param  string  $ReturnAddressRef  Ref Адреса из доступных (CheckPossibilityCreateReturn)
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
     * @param  string  $RecipientWarehouse  Ref отделения
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
     * @param  array  $RecipientSettlement  Массив адреса ['settlement', 'street', 'building', 'other']
     * @return void
     */
    public function setRecipientSettlement(array $RecipientSettlement): void
    {
        $this->RecipientSettlement = $RecipientSettlement;

        // Очищаем данные предыдущих значений по возврату
        $this->ReturnAddressRef = null;
        $this->RecipientWarehouse = null;
    }

    /**
     * @return void
     */
    public function getNumber(): void
    {
        if ($this->Number) {
            $this->methodProperties['Number'] = $this->Number;
        }
    }

    /**
     * Устанавливаем номер заявки на переадресацию.
     *
     * @param  string  $Number  Номер заявки ('102-00010160')
     * @return void
     */
    public function setNumber(string $Number): void
    {
        $this->Number = $Number;
    }

    /**
     * @return void
     */
    public function getCustomer(): void
    {
        $this->methodProperties['Customer'] = $this->Customer ?: 'Sender';
    }

    /**
     * Заказчик переадресации (получателю не разрешается изменять данные получателя).
     *
     * @param  string  $Customer  тип
     * @return void
     */
    public function setCustomer(string $Customer): void
    {
        $this->Customer = $Customer;
    }

    /**
     * @return void
     */
    public function getRecipientData(): void
    {
        if ($this->RecipientData) {
            if (isset($this->methodProperties['Recipient'])) {
                $this->methodProperties['Recipient'] = $this->RecipientData['Recipient'];
            }
            $this->methodProperties['RecipientContactName'] = $this->RecipientData['RecipientContactName'] ?? '';
            $this->methodProperties['RecipientPhone'] = $this->RecipientData['RecipientPhone'] ?? '';

            if (isset($this->methodProperties['SenderContactName'])) {
                $this->methodProperties['SenderContactName'] = $this->RecipientData['SenderContactName'];
            }
            if (isset($this->methodProperties['SenderPhone'])) {
                $this->methodProperties['SenderPhone'] = $this->RecipientData['SenderPhone'];
            }
        }
    }

    /**
     * Смена получателя. Игнорируется, если выполняет получатель
     *
     * @param  array  $RecipientData  тип
     * @return void
     */
    public function changeRecipientData(array $RecipientData): void
    {
        $this->RecipientData = $RecipientData;
    }
}
