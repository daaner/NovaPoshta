<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\CommonFilter;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\Language;
use Daaner\NovaPoshta\Traits\Limit;

class Common extends NovaPoshta
{
    use Language, Limit, CommonFilter, DateTimes;

    protected $model = 'Common';
    protected $calledMethod;
    protected $methodProperties = null;

    public function getOwnershipFormsList()
    {
        $this->calledMethod = 'getOwnershipFormsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getPaymentForms()
    {
        $this->calledMethod = 'getPaymentForms';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getTypesOfCounterparties()
    {
        $this->calledMethod = 'getTypesOfCounterparties';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getServiceTypes()
    {
        $this->calledMethod = 'getServiceTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param string|null $find
     * @return array
     */
    public function getCargoDescriptionList($find = null)
    {
        $this->calledMethod = 'getCargoDescriptionList';
        $this->getPage();

        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getTiresWheelsList()
    {
        $this->calledMethod = 'getTiresWheelsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getPackList()
    {
        $this->calledMethod = 'getPackList';

        $this->getLength();
        $this->getWidth();
        $this->getHeight();
        $this->getVolumetricWeight();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getTypesOfPayersForRedelivery()
    {
        $this->calledMethod = 'getTypesOfPayersForRedelivery';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getTypesOfPayers()
    {
        $this->calledMethod = 'getTypesOfPayers';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getPalletsList()
    {
        $this->calledMethod = 'getPalletsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getBackwardDeliveryCargoTypes()
    {
        $this->calledMethod = 'getBackwardDeliveryCargoTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getCargoTypes()
    {
        $this->calledMethod = 'getCargoTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param string $recipientCityRef
     * @param string|Carbon|date|null $find
     * @return array
     */
    public function getTimeIntervals($recipientCityRef, $dateTime = null)
    {
        $this->calledMethod = 'getTimeIntervals';

        $this->methodProperties['RecipientCityRef'] = $recipientCityRef;

        if ($dateTime && $this->checkDate($dateTime)) {
            $this->methodProperties['DateTime'] = $this->checkDate($dateTime);
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }
}
