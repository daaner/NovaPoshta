<?php

namespace Daaner\NovaPoshta\Traits;

trait SenderProperty
{
    protected $Sender;
    protected $CitySender;
    protected $SenderAddress;
    protected $ContactSender;
    protected $SendersPhone;

    /**
     * Устанавливаем значение отправителя. Если не указывать - значение конфига.
     *
     * @param  array  $sender  Тип отправителя массивом
     * @return void
     */
    public function setSender(array $sender): void
    {
        if (isset($sender['Sender'])) {
            $this->Sender = $sender['Sender'] ?? '';
            $this->CitySender = $sender['CitySender'] ?? '';
            $this->SenderAddress = $sender['SenderAddress'] ?? '';
            $this->ContactSender = $sender['ContactSender'] ?? '';
            $this->SendersPhone = $sender['SendersPhone'] ?? '';
        }
    }

    /**
     * @return void
     */
    public function getSender(): void
    {
        $this->methodProperties['Sender'] = $this->Sender ?: config('novaposhta.sender');
        $this->methodProperties['CitySender'] = $this->CitySender ?: config('novaposhta.city_sender');
        $this->methodProperties['SenderAddress'] = $this->SenderAddress ?: config('novaposhta.sender_address');
        $this->methodProperties['ContactSender'] = $this->ContactSender ?: config('novaposhta.contact_sender');
        $this->methodProperties['SendersPhone'] = $this->SendersPhone ?: config('novaposhta.senders_phone');
    }
}
