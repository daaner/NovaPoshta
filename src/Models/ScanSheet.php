<?php

namespace Daaner\NovaPoshta\Models;

use Carbon\Carbon;
use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\Limit;

class ScanSheet extends NovaPoshta
{
    use Limit, DateTimes;

    protected $model = 'ScanSheet';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Удалить (расформировать) реестр отправлений.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6a2da0fe4f08e8f7ce2f
     *
     * @param  string|array  $ScanSheetRefs
     * @return array
     */
    public function deleteScanSheet($ScanSheetRefs): array
    {
        $this->calledMethod = 'deleteScanSheet';

        if (is_array($ScanSheetRefs) === false) {
            $ScanSheetRefs = explode(', ', /** @scrutinizer ignore-type */ $ScanSheetRefs);
        }

        $this->methodProperties['ScanSheetRefs'] = array_values(/** @scrutinizer ignore-type */ $ScanSheetRefs);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Добавить экспресс-накладные в реестр.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c4786a0fe4f0634657b65
     *
     * @param  string|array  $DocumentRefs
     * @param  string|null  $Ref
     * @param  string|Carbon|null  $Date
     * @return array
     */
    public function insertDocuments($DocumentRefs, ?string $Ref = null, $Date = null): array
    {
        $this->calledMethod = 'insertDocuments';

        if (is_array($DocumentRefs) === false) {
            $DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
        }

        $this->methodProperties['DocumentRefs'] = array_values(/** @scrutinizer ignore-type */ $DocumentRefs);

        if ($Ref) {
            $this->methodProperties['Ref'] = $Ref;
        }

        if ($Date && $newDate = $this->checkDate($Date)) {
            $this->methodProperties['Date'] = $newDate;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Загрузить список реестров.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c7734a0fe4f08e8f7ce31
     *
     * @return array
     */
    public function getScanSheetList(): array
    {
        $this->calledMethod = 'getScanSheetList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Загрузить информацию по одному реестру.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c72d7a0fe4f08e8f7ce30
     *
     * @param  string  $ref
     * @return array
     */
    public function getScanSheet(string $ref): array
    {
        $this->calledMethod = 'getScanSheet';

        $this->methodProperties = [];
        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Удалить экспресс-накладные из реестра.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6474a0fe4f08e8f7ce2e
     *
     * @param  string|array  $documents
     * @param  string|null  $ref
     * @return array
     */
    public function removeDocuments($documents, ?string $ref = null): array
    {
        $this->calledMethod = 'removeDocuments';

        $this->methodProperties = [];
        if ($ref) {
            $this->methodProperties['Ref'] = $ref;
        }

        if (is_array($documents) === false) {
            $documents = explode(', ', /** @scrutinizer ignore-type */ $documents);
        }

        $this->methodProperties['DocumentRefs'] = array_values(/** @scrutinizer ignore-type */ $documents);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получить краткий список ТТН реестра.
     * Не документировано.
     *
     * @param  string  $ref
     * @return array
     */
    public function getScanSheetDocuments(string $ref): array
    {
        $this->methodProperties = [];
        $this->getPage();
        $this->addLimit();

        $this->calledMethod = 'getScanSheetDocuments';
        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Обновить описание реестра.
     * Не документировано.
     *
     * @param  string  $ref
     * @param  string|int  $description
     * @return array
     */
    public function updateScanSheet(string $ref, $description): array
    {
        $this->methodProperties = [];

        $this->calledMethod = 'updateScanSheet';
        $this->methodProperties['Ref'] = $ref;
        $this->methodProperties['Description'] = $description;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
