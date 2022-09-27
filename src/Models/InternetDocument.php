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

    /**
     * getDocumentList
     * getMoneyTransferDocuments
     */
    use Limit, DateTimes;

    /**
     * getDocumentList
     */
    use DocumentList;

    /**
     * save
     */
    use InternetDocumentProperty, SenderProperty, OptionsSeatProperty, RecipientProperty;


    protected $model = 'InternetDocument';
    protected $calledMethod;
    protected $methodProperties = [];

    /**
     * Получить список ЭН.
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9d22b34-8512-11ec-8ced-005056b2dbe1
     *
     * @return array
     */
    public function getDocumentList(): array
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
     * Создать экспресс-накладную.
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a965630e-8512-11ec-8ced-005056b2dbe1
     *
     * @param string|null $description
     * @return array
     */
    public function save(string $description = null): array
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

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Удаление экспресс-накладной
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9f43ff1-8512-11ec-8ced-005056b2dbe1
     *
     * @param string|array $DocumentRefs
     * @return array
     */
    public function delete($DocumentRefs): array
    {
        $this->calledMethod = 'delete';

        if (is_array($DocumentRefs) === false) {
            $DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
        }

        $this->methodProperties['DocumentRefs'] = array_values(/** @scrutinizer ignore-type */ $DocumentRefs);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получить данные о платежах за определенный период
     *
     * @param null $dateFrom
     * @param null $dateTo
     * @return array
     */
    public function getMoneyTransferDocuments($dateFrom = null, $dateTo = null)
    {
        $this->calledMethod = 'getMoneyTransferDocuments';

        $this->addLimit();
        $this->getPage();
        $this->getDateFromTo($dateFrom, $dateTo);

        // dd($this->methodProperties);
        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
