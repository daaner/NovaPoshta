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
     * @param string $Sender
     * Устанавливаем значение отправителя. Если не указывать - значение из конфига
     * @return this
     */
    public function setSender($Sender)
    {
        if (isset($Sender['Sender'])) {
            $this->Sender = isset($Sender['Sender']) ? $Sender['Sender'] : '';
            $this->CitySender = isset($Sender['CitySender']) ? $Sender['CitySender'] : '';
            $this->SenderAddress = isset($Sender['SenderAddress']) ? $Sender['SenderAddress'] : '';
            $this->ContactSender = isset($Sender['ContactSender']) ? $Sender['ContactSender'] : '';
            $this->SendersPhone = isset($Sender['SendersPhone']) ? $Sender['SendersPhone'] : '';
        }

        return $this;
    }

    public function getSender()
    {
        //конструктор нельзя, потому как трейт
        if (! $this->Sender) {
            $this->Sender = config('novaposhta.sender');
        }
        if (! $this->CitySender) {
            $this->CitySender = config('novaposhta.sender');
        }
        if (! $this->SenderAddress) {
            $this->SenderAddress = config('novaposhta.sender_address');
        }
        if (! $this->ContactSender) {
            $this->ContactSender = config('novaposhta.contact_sender');
        }
        if (! $this->SendersPhone) {
            $this->SendersPhone = config('novaposhta.senders_phone');
        }

        $this->methodProperties['Sender'] = $this->Sender;
        $this->methodProperties['CitySender'] = $this->CitySender;
        $this->methodProperties['SenderAddress'] = $this->SenderAddress;
        $this->methodProperties['ContactSender'] = $this->ContactSender;
        $this->methodProperties['SendersPhone'] = $this->SendersPhone;

        return $this;
    }
}
