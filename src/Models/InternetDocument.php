<?php

namespace Daaner\NovaPoshta\Models;

use Carbon\Carbon;
use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\DocumentList;
use Daaner\NovaPoshta\Traits\InternetDocumentProperty;
use Daaner\NovaPoshta\Traits\Limit;
use Daaner\NovaPoshta\Traits\OptionsSeatProperty;
use Daaner\NovaPoshta\Traits\PDFDocumentProperty;
use Daaner\NovaPoshta\Traits\RecipientProperty;
use Daaner\NovaPoshta\Traits\SenderProperty;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Date;

class InternetDocument extends NovaPoshta
{
    /**
     * getDocumentList
     * getMoneyTransferDocuments.
     */
    use Limit, DateTimes;

    /**
     * getDocumentList.
     */
    use DocumentList;

    /**
     * save.
     */
    use InternetDocumentProperty, SenderProperty, OptionsSeatProperty, RecipientProperty;

    /**
     * getPDF.
     */
    use PDFDocumentProperty;

    protected $model = 'InternetDocument';
    protected $calledMethod;
    protected $methodProperties = [];

    /**
     * Получить список ЭН.
     *
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9d22b34-8512-11ec-8ced-005056b2dbe1 Получить список ЭН
     *
     * @return array
     */
    public function getDocumentList(): array
    {
        $this->calledMethod = 'getDocumentList';

        $this->getPage();
        $this->getLimit();

        //DateTime
        $this->getDateTime();
        $this->getDateTimeFromTo();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Создать экспресс-накладную.
     *
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a965630e-8512-11ec-8ced-005056b2dbe1 Создать экспресс-накладную
     *
     * @param  string|null  $description  Описание посылки
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
     * Удаление экспресс-накладной.
     *
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9f43ff1-8512-11ec-8ced-005056b2dbe1 Удаление экспресс-накладной
     *
     * @param  string|array  $DocumentRefs  Ref или массив Ref ТТН
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
     * Получить данные о платежах за определенный период.
     *
     * @since 2022-11-06 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  null|string|Carbon|date  $dateFrom  Начиная с текущей даты
     * @param  null|string|Carbon|date  $dateTo  До текущей даты
     * @return array
     */
    public function getMoneyTransferDocuments($dateFrom = null, $dateTo = null): array
    {
        $this->calledMethod = 'getMoneyTransferDocuments';

        $this->getLimit();
        $this->getPage();
        $this->getDateFromTo($dateFrom, $dateTo);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Редактирование экспресс-накладной.
     *
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a98a4354-8512-11ec-8ced-005056b2dbe1 Редактирование экспресс-накладной
     *
     * @author https://github.com/seriklav/NovaPoshta
     *
     * TODO need tested
     *
     * @since НЕ ПРОВЕРЕНО
     *
     * @param  string|null  $description  Описание
     * @return array
     */
    public function edit(?string $description = null): array
    {
        $this->calledMethod = 'update';

        $this->getRef();

        $this->getPayerType();
        $this->getServiceType();
        $this->getPaymentMethod();
        $this->getCargoType();

        $this->getDateTime();
        $this->setDescription($description);
        $this->getSeatsAmount();
        $this->getCost();
        $this->getWeight();
//        $this->getOptionsSeat();

        //Отправитель и другое
        $this->getSender();
        $this->getRecipientType();
        $this->getBackwardDeliveryData();
        $this->getNote();
        $this->getAdditionalInformation();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Прогноз даты доставки груза.
     *
     * @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a941c714-8512-11ec-8ced-005056b2dbe1 Прогноз даты доставки груза
     *
     * @author https://github.com/seriklav/NovaPoshta
     *
     * @param  string  $CitySender  Ref города отправителя
     * @param  string  $CityRecipient  Ref города получателя
     * @param  string|null  $DateTime  Дата ориентировочной отправки
     * @param  string|null  $ServiceType  Тип доставки ('DoorsDoors', 'DoorsWarehouse', 'WarehouseWarehouse', 'WarehouseDoors')
     * @return array
     */
    public function getDocumentDeliveryDate(
        string $CitySender,
        string $CityRecipient,
        ?string $DateTime = null,
        ?string $ServiceType = null
    ): array {
        $this->calledMethod = 'getDocumentDeliveryDate';

        $this->methodProperties['CitySender'] = $CitySender;
        $this->methodProperties['CityRecipient'] = $CityRecipient;

        if ($DateTime) {
            $this->methodProperties['DateTime'] = $this->checkDate($DateTime, 'd.m.Y');
        }

        $this->methodProperties['ServiceType'] = $ServiceType ?? config('novaposhta.service_type');

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Печать накладной.
     *
     * @param  string|array  $DocumentRefs  Ref либо ТТН (можно и массивом Ref или ТТН)
     * @param  bool  $getStreamFile  Получать файл сразу (false - в массиве в ключе result)
     *
     * @throws BindingResolutionException
     */
    public function getPDF($DocumentRefs, bool $getStreamFile)
    {
        $this->calledMethod = 'printFull';

        if (is_array($DocumentRefs) === false) {
            $DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
        }

        $this->getPrintForm();

        /**
         * Форсирование параметров, при определенных условиях.
         */
        if ($this->printForm == 'ScanSheet') {
            $this->setThisIsScansheet();

            $this->methodProperties['PrintOrientation'] = $this->PrintOrientation;
            $this->Type = 'pdf';

            $this->PageFormat = null;
            $this->Position = 1;
            $this->Copies = 1;
        }

        if ($this->printForm == 'Document_new') {
            $this->Type = 'pdf';

            $this->Copies = $this->Copies ?: 1;
            $this->PageFormat = $this->PageFormat ?: 'A4';
        }

        if ($this->printForm == 'Marking_85x85') {
            $this->PageFormat = 'A4';
            $this->Type = 'pdf8';
        }

        if ($this->printForm == 'Marking_100x100') {
            $this->PageFormat = null;
            $this->Type = 'pdf';
            $this->Position = '';
        }

        if ($this->isScansheet) {
            $this->methodProperties['ScanSheetRefs'] = $DocumentRefs;
        } else {
            $this->methodProperties['DocumentRefs'] = $DocumentRefs;
        }

        $this->getPageFormat();
        $this->getCopies();
        $this->getPosition();
        $this->getType();

        if ($getStreamFile) {
            $data = $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);

            $file = null;
            $status = 500;
            $filename = microtime(false).'.pdf';

            if (isset($data['info']['file']) && $data['info']['file'] && $data['success']) {
                $file = $data['result'];
                $status = 200;
            }

            return response()->make($file, $status, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"',
            ]);
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
