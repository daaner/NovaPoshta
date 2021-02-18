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
	 * @param string $Ref
	 *
	 * @return $this
	 */
	public function setRef(string $Ref)
	{
		$this->Ref = $Ref;

		return $this;
	}

	public function getRef()
	{
		if (!$this->Ref) {
			return $this;
		}
		$this->methodProperties['Ref'] = $this->Ref;

		return $this;
	}

    /**
     * @param string $PayerType
     * Устанавливаем значение плательщика. По умолчанию значение из конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913
     * @return $this
     */
    public function setPayerType($PayerType)
    {
        $this->PayerType = $PayerType;

        return $this;
    }

    public function getPayerType()
    {
        if (! $this->PayerType) {
            $this->PayerType = config('novaposhta.payer_type');
        }
        $this->methodProperties['PayerType'] = $this->PayerType;

        return $this;
    }

    /**
     * @param string $ServiceType
     * Устанавливаем тип доставки. По умолчанию значение из конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890e
     * @return $this
     */
    public function setServiceType($ServiceType)
    {
        $this->ServiceType = $ServiceType;

        return $this;
    }

    public function getServiceType()
    {
        if (! $this->ServiceType) {
            $this->ServiceType = config('novaposhta.service_type');
        }
        $this->methodProperties['ServiceType'] = $this->ServiceType;

        return $this;
    }

    /**
     * @param string $PaymentMethod
     * Устанавливаем форму оплаты. По умолчанию значение из конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890d
     * @return $this
     */
    public function setPaymentMethod($PaymentMethod)
    {
        $this->PaymentMethod = $PaymentMethod;

        return $this;
    }

    public function getPaymentMethod()
    {
        if (! $this->PaymentMethod) {
            $this->PaymentMethod = config('novaposhta.payment_method');
        }
        $this->methodProperties['PaymentMethod'] = $this->PaymentMethod;

        return $this;
    }

    /**
     * @param string $CargoType
     * Устанавливаем тип груза. По умолчанию значение из конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909
     * @return this
     */
    public function setCargoType($CargoType)
    {
        $this->CargoType = $CargoType;

        return $this;
    }

    public function getCargoType()
    {
        if (! $this->CargoType) {
            $this->CargoType = config('novaposhta.cargo_type');
        }
        $this->methodProperties['CargoType'] = $this->CargoType;

        return $this;
    }

    /**
     * @param string $Description
     * Устанавливаем описание груза. По умолчанию из конфига
     * @return this
     */
    public function setDescription($Description)
    {
        if ($Description) {
            $this->methodProperties['Description'] = $Description;
        } else {
            $this->methodProperties['Description'] = config('novaposhta.description');
        }

        return $this;
    }

    /**
     * @param string $SeatsAmount
     * Кол-во мест груза по умолчанию
     * @return this
     */
    public function setSeatsAmount($SeatsAmount)
    {
        $this->SeatsAmount = $SeatsAmount;

        return $this;
    }

    public function getSeatsAmount()
    {
        if (! $this->SeatsAmount) {
            $this->SeatsAmount = config('novaposhta.seats_amount');
        }
        $this->methodProperties['SeatsAmount'] = $this->SeatsAmount;

        return $this;
    }

    /**
     * @param string $Cost
     * Устанавливаем стоимость груза. По умолчанию значение из конфига
     * @return this
     */
    public function setCost($Cost)
    {
        $this->Cost = $Cost;

        return $this;
    }

    public function getCost()
    {
        if (! $this->Cost) {
            $this->Cost = config('novaposhta.cost');
        }
        $this->methodProperties['Cost'] = $this->Cost;

        return $this;
    }

    /**
     * @param string $Note
     * Описание к адресу для курьера или отделения
     * Применяется в основном, если нет текущей улицы при адресной доставке
     * @return this
     */
    public function setNote($Note)
    {
        $this->Note = $Note;

        return $this;
    }

    public function getNote()
    {
        if ($this->Note) {
            $this->methodProperties['Note'] = $this->Note;
        }

        return $this;
    }

    /**
     * @param string $AdditionalInformation
     * Описание к ТТН для отображения в кабинете
     * @return this
     */
    public function setAdditionalInformation($AdditionalInformation)
    {
        $this->AdditionalInformation = $AdditionalInformation;

        return $this;
    }

    public function getAdditionalInformation()
    {
        if ($this->AdditionalInformation) {
            $this->methodProperties['AdditionalInformation'] = $this->AdditionalInformation;
        }

        return $this;
    }

    /**
     * @param string|int $RedeliveryString
     * @param string|null $PayerType
     * @param string|null $CargoType
     * @param array|null $addition
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/575fe852a0fe4f0aa0754760
     * Услуга обратной доставки. По умолчанию значения из конфига
     * @return this
     */
    public function setBackwardDeliveryData($RedeliveryString, $PayerType = null, $CargoType = null)
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

    public function getBackwardDeliveryData()
    {
        if ($this->BackwardDeliveryData) {
            $this->methodProperties['BackwardDeliveryData'][] = $this->BackwardDeliveryData;
        }

        return $this;
    }
}
