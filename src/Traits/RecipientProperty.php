<?php

namespace Daaner\NovaPoshta\Traits;

trait RecipientProperty
{

    protected $RecipientType;

    /**
     * @param string $Recipient
     * Устанавливаем значение получателя
     * @return this
     */
    public function setRecipient($Recipient)
    {
        if (isset($Recipient['RecipientsPhone'])) {
            $this->methodProperties['RecipientsPhone'] = $Recipient['RecipientsPhone'];
        }

        //указываем идентификаторами проверяем и вставляем
        if (isset($Recipient['Recipient']) &&
            isset($Recipient['ContactRecipient']) &&
            isset($Recipient['CityRecipient']) &&
            isset($Recipient['RecipientAddress'])
        ) {
            $this->methodProperties['Recipient'] = $Recipient['Recipient'];
            $this->methodProperties['ContactRecipient'] = $Recipient['ContactRecipient'];
            $this->methodProperties['CityRecipient'] = $Recipient['CityRecipient'];
            $this->methodProperties['RecipientAddress'] = $Recipient['RecipientAddress'];

            return $this;
        }

        //указываем строками проверяем и вставляем
        if (isset($Recipient['RecipientName']) &&     //имя получателя
            isset($Recipient['RecipientCityName']) && //город
            isset($Recipient['RecipientAddressName']) //отделение или улица
        ) {
            //создаем новый адрес
            $this->methodProperties['NewAddress'] = 1;

            $this->methodProperties['RecipientName'] = $Recipient['RecipientName'];
            $this->methodProperties['RecipientCityName'] = $Recipient['RecipientCityName'];
            $this->methodProperties['RecipientAddressName'] = $Recipient['RecipientAddressName'];

            $this->methodProperties['RecipientArea'] = isset($Recipient['RecipientArea']) ? $Recipient['RecipientArea'] : '';
            $this->methodProperties['RecipientAreaRegions'] = isset($Recipient['RecipientAreaRegions']) ? $Recipient['RecipientAreaRegions'] : '';
            $this->methodProperties['RecipientHouse'] = isset($Recipient['RecipientHouse']) ? $Recipient['RecipientHouse'] : '';
            $this->methodProperties['RecipientFlat'] = isset($Recipient['RecipientFlat']) ? $Recipient['RecipientFlat'] : '';
        }

        return $this;
    }


    /**
     * @param string $SeatsAmount
     * Устанавливаем тип груза. По умолчанию значение из конфига
     * @see https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909
     * @return this
     */
    public function setRecipientType($RecipientType)
    {
        $this->RecipientType = $RecipientType;

        return $this;
    }

    public function getRecipientType()
    {
        if (! $this->RecipientType) {
            $this->RecipientType = config('novaposhta.recipient_type');
        }
        $this->methodProperties['RecipientType'] = $this->RecipientType;

        return $this;
    }

}
