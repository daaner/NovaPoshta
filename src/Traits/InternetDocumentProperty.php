<?php

namespace Daaner\NovaPoshta\Traits;

trait InternetDocumentProperty
{
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
     * Устанавливаем значение плательщика. По умолчанию значение конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913
     *
     * @param string $PayerType
     * @return $this
     */
    public function setPayerType(string $PayerType)
    {
        $this->PayerType = $PayerType;

        return $this;
    }

    /**
     * @return $this
     */
    public function getPayerType()
    {
        $this->methodProperties['PayerType'] = $this->PayerType ?: config('novaposhta.payer_type');

        return $this;
    }

    /**
     * Устанавливаем тип доставки. По умолчанию значение конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890e
     *
     * @param string $ServiceType
     * @return $this
     */
    public function setServiceType(string $ServiceType)
    {
        $this->ServiceType = $ServiceType;

        return $this;
    }

    /**
     * @return $this
     */
    public function getServiceType()
    {
        $this->methodProperties['ServiceType'] = $this->ServiceType ?: config('novaposhta.service_type');

        return $this;
    }

    /**
     * Устанавливаем форму оплаты. По умолчанию значение конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890d
     *
     * @param string $PaymentMethod
     * @return $this
     */
    public function setPaymentMethod(string $PaymentMethod)
    {
        $this->PaymentMethod = $PaymentMethod;

        return $this;
    }

    /**
     * @return $this
     */
    public function getPaymentMethod()
    {
        $this->methodProperties['PaymentMethod'] = $this->PaymentMethod ?: config('novaposhta.payment_method');

        return $this;
    }

    /**
     * Устанавливаем тип груза. По умолчанию значение конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909
     *
     * @param string $CargoType
     * @return $this
     */
    public function setCargoType(string $CargoType)
    {
        $this->CargoType = $CargoType;

        return $this;
    }

    /**
     * @return $this
     */
    public function getCargoType()
    {
        $this->methodProperties['CargoType'] = $this->CargoType ?: config('novaposhta.cargo_type');

        return $this;
    }

    /**
     * Устанавливаем описание груза. По умолчанию из конфига.
     *
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description)
    {
        $this->methodProperties['Description'] = $description ?: config('novaposhta.description');

        return $this;
    }

    /**
     * Кол-во мест груза по умолчанию
     *
     * @param string $SeatsAmount
     * @return $this
     */
    public function setSeatsAmount(string $SeatsAmount)
    {
        $this->SeatsAmount = $SeatsAmount;

        return $this;
    }

    /**
     * @return $this
     */
    public function getSeatsAmount()
    {
        $this->methodProperties['SeatsAmount'] = $this->SeatsAmount ?: config('novaposhta.seats_amount');

        return $this;
    }

    /**
     * Устанавливаем стоимость груза. По умолчанию значение конфига.
     *
     * @param string $cost
     * @return $this
     */
    public function setCost(string $cost)
    {
        $this->Cost = $cost;

        return $this;
    }

    /**
     * @return $this
     */
    public function getCost()
    {
        $this->methodProperties['Cost'] = $this->Cost ?: config('novaposhta.cost');

        return $this;
    }

    /**
     * Описание к адресу для курьера или отделения.
     * Применяется в основном, если нет текущей улицы при адресной доставке.
     *
     * @param string $note
     * @return $this
     */
    public function setNote(string $note)
    {
        $this->Note = $note;

        return $this;
    }

    /**
     * @return $this
     */
    public function getNote()
    {
        if ($this->Note) {
            $this->methodProperties['Note'] = $this->Note;
        }

        return $this;
    }

    /**
     * Описание к ТТН для отображения в кабинете
     *
     * @param string $AdditionalInformation
     * @return $this
     */
    public function setAdditionalInformation(string $AdditionalInformation)
    {
        $this->AdditionalInformation = $AdditionalInformation;

        return $this;
    }

    /**
     * @return $this
     */
    public function getAdditionalInformation()
    {
        if ($this->AdditionalInformation) {
            $this->methodProperties['AdditionalInformation'] = $this->AdditionalInformation;
        }

        return $this;
    }

    /**
     * Услуга обратной доставки. По умолчанию значения конфига.
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/575fe852a0fe4f0aa0754760
     *
     * @param string|int $RedeliveryString
     * @param string|null $PayerType
     * @param string|null $CargoType
     * @return $this
     */
    public function setBackwardDeliveryData($RedeliveryString, ?string $PayerType = null, ?string $CargoType = null)
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

        return $this;
    }

    /**
     * @return $this
     */
    public function getBackwardDeliveryData()
    {
        if ($this->BackwardDeliveryData) {
            $this->methodProperties['BackwardDeliveryData'][] = $this->BackwardDeliveryData;
        }

        return $this;
    }
}
