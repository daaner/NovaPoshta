<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\DocumentList;
use Daaner\NovaPoshta\Traits\InternetDocumentProperty;
use Daaner\NovaPoshta\Traits\Limit;
use Daaner\NovaPoshta\Traits\OptionsSeatProperty;
use Daaner\NovaPoshta\Traits\RecipientProperty;
use Daaner\NovaPoshta\Traits\SenderProperty;

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

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/556ef753a0fe4f02049c664f
     *
     * @param string|null $description
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
	    $this->getWeight();
	    $this->getDateTime();
        $this->getOptionsSeat();

        //Отправитель и другое
        $this->getSender();
        $this->getRecipientType();
        $this->getBackwardDeliveryData();
        $this->getNote();
        $this->getAdditionalInformation();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55701fa5a0fe4f0cf4fc53ec
     *
     * @param string|array $DocumentRefs
     * @return array
     */
    public function delete($DocumentRefs)
    {
        $this->calledMethod = 'delete';

        if (is_array($DocumentRefs) === false) {
            $DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
        }

        $this->methodProperties['DocumentRefs'] = array_values(/** @scrutinizer ignore-type */ $DocumentRefs);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
