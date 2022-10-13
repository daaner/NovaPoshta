<?php

namespace Daaner\NovaPoshta\Traits;

trait InternetDocumentProperty
{
    protected $Ref;
    protected $PayerType;
    protected $ServiceType;
    protected $PaymentMethod;
    protected $CargoType;
    protected $SeatsAmount;
    protected $Cost;
    protected $Weight;
    protected $BackwardDeliveryData;
    protected $Note;
    protected $AdditionalInformation;

    /**
     * Устанавливаем значение Ref.
     *
     * @param  string  $Ref
     */
    public function setRef(string $Ref): void
    {
        $this->Ref = $Ref;
    }

    public function getRef(): void
    {
        $this->methodProperties['Ref'] = $this->Ref;
    }

    /**
     * Устанавливаем значение плательщика. По умолчанию значение конфига.
     *
     * @param  string  $PayerType
     * @return void
     */
    public function setPayerType(string $PayerType): void
    {
        $this->PayerType = $PayerType;
    }

    /**
     * @return void
     */
    public function getPayerType(): void
    {
        $this->methodProperties['PayerType'] = $this->PayerType ?: config('novaposhta.payer_type');
    }

    /**
     * Устанавливаем тип доставки. По умолчанию значение конфига.
     *
     * @param  string  $ServiceType
     * @return void
     */
    public function setServiceType(string $ServiceType): void
    {
        $this->ServiceType = $ServiceType;
    }

    /**
     * @return void
     */
    public function getServiceType(): void
    {
        $this->methodProperties['ServiceType'] = $this->ServiceType ?: config('novaposhta.service_type');
    }

    /**
     * Устанавливаем форму оплаты. По умолчанию значение конфига.
     *
     * @param  string  $PaymentMethod
     * @return void
     */
    public function setPaymentMethod(string $PaymentMethod): void
    {
        $this->PaymentMethod = $PaymentMethod;
    }

    /**
     * @return void
     */
    public function getPaymentMethod(): void
    {
        if ($this->model == 'AdditionalService') {
            $this->methodProperties['PaymentMethod'] = $this->PaymentMethod ?: config('novaposhta.return_cash_method');
        } else {
            $this->methodProperties['PaymentMethod'] = $this->PaymentMethod ?: config('novaposhta.payment_method');
        }
    }

    /**
     * Устанавливаем тип груза. По умолчанию значение конфига.
     *
     * @param  string  $CargoType
     * @return void
     */
    public function setCargoType(string $CargoType): void
    {
        $this->CargoType = $CargoType;
    }

    /**
     * @return void
     */
    public function getCargoType(): void
    {
        $this->methodProperties['CargoType'] = $this->CargoType ?: config('novaposhta.cargo_type');
    }

    /**
     * Устанавливаем описание груза. По умолчанию из конфига.
     *
     * @param  string|null  $description
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->methodProperties['Description'] = $description ?: config('novaposhta.description');
    }

    /**
     * Кол-во мест груза по умолчанию.
     *
     * @param  string  $SeatsAmount
     * @return void
     */
    public function setSeatsAmount(string $SeatsAmount): void
    {
        $this->SeatsAmount = $SeatsAmount;
    }

    /**
     * @return void
     */
    public function getSeatsAmount(): void
    {
        $this->methodProperties['SeatsAmount'] = $this->SeatsAmount ?: config('novaposhta.seats_amount');
    }

    /**
     * Устанавливаем стоимость груза. По умолчанию значение конфига.
     *
     * @param  string  $cost
     * @return void
     */
    public function setCost(string $cost): void
    {
        $this->Cost = $cost;
    }

    /**
     * @return void
     */
    public function getCost(): void
    {
        $this->methodProperties['Cost'] = $this->Cost ?: config('novaposhta.cost');
    }

    /**
     * Описание к адресу для курьера или отделения.
     * Применяется в основном, если нет текущей улицы при адресной доставке.
     *
     * @param  string  $note
     * @return void
     */
    public function setNote(string $note): void
    {
        $this->Note = $note;
    }

    /**
     * @return void
     */
    public function getNote(): void
    {
        if ($this->Note) {
            $this->methodProperties['Note'] = $this->Note;
        }
    }

    /**
     * Описание к ТТН для отображения в кабинете.
     *
     * @param  string  $AdditionalInformation
     * @return void
     */
    public function setAdditionalInformation(string $AdditionalInformation): void
    {
        $this->AdditionalInformation = $AdditionalInformation;
    }

    /**
     * @return void
     */
    public function getAdditionalInformation(): void
    {
        if ($this->AdditionalInformation) {
            $this->methodProperties['AdditionalInformation'] = $this->AdditionalInformation;
        }
    }

    /**
     * Услуга обратной доставки. По умолчанию значения конфига.
     *
     * @param  string|int  $RedeliveryString
     * @param  string|null  $PayerType
     * @param  string|null  $CargoType
     * @return void
     */
    public function setBackwardDeliveryData($RedeliveryString, ?string $PayerType = null, ?string $CargoType = null): void
    {
        if (! $PayerType) {
            $PayerType = config('novaposhta.back_delivery_payer_type');
        }
        if (! $CargoType) {
            $CargoType = config('novaposhta.back_delivery_cargo_type');
        }
        $this->BackwardDeliveryData = [
            'PayerType' => $PayerType,
            'CargoType' => $CargoType,
            'RedeliveryString' => $RedeliveryString,
        ];
    }

    /**
     * @return void
     */
    public function getBackwardDeliveryData(): void
    {
        if ($this->BackwardDeliveryData) {
            $this->methodProperties['BackwardDeliveryData'][] = $this->BackwardDeliveryData;
        }
    }
}
