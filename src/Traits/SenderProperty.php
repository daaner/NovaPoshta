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
     * @return $this
     */
    public function setSender(array $sender): self
    {
        if (isset($sender['Sender'])) {
            $this->Sender = $sender['Sender'] ?? null;
            $this->CitySender = $sender['CitySender'] ?? null;
            $this->SenderAddress = $sender['SenderAddress'] ?? null;
            $this->ContactSender = $sender['ContactSender'] ?? null;
            $this->SendersPhone = $sender['SendersPhone'] ?? null;
        }

        return $this;
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
