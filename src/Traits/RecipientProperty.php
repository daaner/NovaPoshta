<?php

namespace Daaner\NovaPoshta\Traits;

trait RecipientProperty
{
    protected $RecipientType;

    /**
     * Устанавливаем значение получателя.
     *
     * @param  array  $Recipient  Массив данных получателя
     * @return void
     */
    public function setRecipient(array $Recipient): void
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

            return;
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

            $this->methodProperties['RecipientArea'] = $Recipient['RecipientArea'] ?? '';
            $this->methodProperties['RecipientAreaRegions'] = $Recipient['RecipientAreaRegions'] ?? '';
            $this->methodProperties['RecipientHouse'] = $Recipient['RecipientHouse'] ?? '';
            $this->methodProperties['RecipientFlat'] = $Recipient['RecipientFlat'] ?? '';
        }
    }

    /**
     * Устанавливаем тип получателя.
     *
     * @param  string  $RecipientType  Тип получателя ('PrivatePerson', 'Organization')
     * @return void
     */
    public function setRecipientType(string $RecipientType): void
    {
        $this->RecipientType = $RecipientType;
    }

    /**
     * Тип получателя. По-умолчанию значение конфига.
     *
     * @return void
     */
    public function getRecipientType(): void
    {
        $this->methodProperties['RecipientType'] = $this->RecipientType ?: config('novaposhta.recipient_type');
    }
}
