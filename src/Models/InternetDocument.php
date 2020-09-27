<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\DocumentList;
use Daaner\NovaPoshta\Traits\Limit;

use Daaner\NovaPoshta\Traits\InternetDocumentProperty;
use Daaner\NovaPoshta\Traits\SenderProperty;
use Daaner\NovaPoshta\Traits\OptionsSeatProperty;
use Daaner\NovaPoshta\Traits\RecipientProperty;

class InternetDocument extends NovaPoshta
{
    use Limit, DateTimes, DocumentList; //getDocumentList

    use InternetDocumentProperty, SenderProperty, OptionsSeatProperty, RecipientProperty; //save

    protected $model = 'InternetDocument';
    protected $calledMethod;
    protected $methodProperties = [];

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/557eb417a0fe4f02fc455b2c
     *
     * @return array
     */
    public function getDocumentList()
    {
        $this->calledMethod = 'getDocumentList';

        $this->getPage();
        $this->addLimit();

        //DateTime
        $this->getDateTime();
        $this->getDateTimeFromTo();
        // $this->getFullList();

        // $methodProperties = [
        //     'GetFullList' => 0,
        // ];

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }


    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/556ef753a0fe4f02049c664f
     *
     * @return array
     */
    public function save($description = null)
    {
        $this->calledMethod = 'save';

        $this->getPayerType();
        $this->getServiceType();
        $this->getPaymentMethod();
        $this->getCargoType();

        $this->getDateTime();
        $this->setDescription($description);
        $this->getSeatsAmount();
        $this->getCost();
        $this->getOptionsSeat();

        //Отправитель и другое
        $this->getSender();
        $this->getRecipientType();
        $this->getBackwardDeliveryData();
        $this->getNote();
        $this->getAdditionalInformation();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
