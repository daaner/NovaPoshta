<?php

namespace Daaner\NovaPoshta\Models;

use Carbon\Carbon;
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

    /**
     * @return array
     */
    public function getOwnershipFormsList(): array
    {
        $this->calledMethod = 'getOwnershipFormsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getPaymentForms(): array
    {
        $this->calledMethod = 'getPaymentForms';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getTypesOfCounterparties(): array
    {
        $this->calledMethod = 'getTypesOfCounterparties';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getServiceTypes(): array
    {
        $this->calledMethod = 'getServiceTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param string|null $find
     * @return array
     */
    public function getCargoDescriptionList(?string $find = null): array
    {
        $this->calledMethod = 'getCargoDescriptionList';
        $this->getPage();

        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getTiresWheelsList(): array
    {
        $this->calledMethod = 'getTiresWheelsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getPackList(): array
    {
        $this->calledMethod = 'getPackList';

        $this->getLength();
        $this->getWidth();
        $this->getHeight();
        $this->getVolumetricWeight();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getTypesOfPayersForRedelivery(): array
    {
        $this->calledMethod = 'getTypesOfPayersForRedelivery';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getTypesOfPayers(): array
    {
        $this->calledMethod = 'getTypesOfPayers';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getPalletsList(): array
    {
        $this->calledMethod = 'getPalletsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getBackwardDeliveryCargoTypes(): array
    {
        $this->calledMethod = 'getBackwardDeliveryCargoTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @return array
     */
    public function getCargoTypes(): array
    {
        $this->calledMethod = 'getCargoTypes';
        $this->getLanguage();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param string $recipientCityRef
     * @param string|Carbon|null $dateTime
     * @return array
     */
    public function getTimeIntervals(string $recipientCityRef, $dateTime = null): array
    {
        $this->calledMethod = 'getTimeIntervals';

        $this->methodProperties['RecipientCityRef'] = $recipientCityRef;

        if ($dateTime && $newDate = $this->checkDate($dateTime)) {
            $this->methodProperties['DateTime'] = $newDate;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }
}
