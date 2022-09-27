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
