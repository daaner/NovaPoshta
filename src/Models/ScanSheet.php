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
     * @see https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a50e049b-8512-11ec-8ced-005056b2dbe1 Расформировать реестр
     * @since 2022-11-07
     *
     * @param  string|array  $ScanSheetRefs  Ref реестра
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
     * @see https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a482293c-8512-11ec-8ced-005056b2dbe1 Добавить экспресс-накладные в реестр
     * @since 2022-11-07
     *
     * @param  string|array  $DocumentRefs  Ref или массив Ref ТТН
     * @param  string|null  $Ref  Ref реестра, если есть
     * @param  string|Carbon|null  $Date  Дата, если необходимо создать реестр на определенную дату
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
     * @see https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a4abdd36-8512-11ec-8ced-005056b2dbe1 Загрузить список реестров
     * @since 2022-11-07
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
     * @since 2022-11-07 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string  $ref  Ref реестра
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
     * @see https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a53dea8a-8512-11ec-8ced-005056b2dbe1 Удалить экспресс-накладные из реестра
     * @since 2022-11-07
     *
     * @param  string|array  $documents  Ref или массив Ref ТТН
     * @param  string|null  $ref  Ref реестра
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
     *
     * @since 2022-11-07
     *
     * @param  string  $ref  Ref реестра
     * @return array
     */
    public function getScanSheetDocuments(string $ref): array
    {
        $this->methodProperties = [];
        $this->getPage();
        $this->getLimit();

        $this->calledMethod = 'getScanSheetDocuments';
        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Обновить описание реестра.
     *
     * @since 2022-11-07
     *
     * @param  string  $ref  Ref реестра
     * @param  string  $description  Описание
     * @return array
     */
    public function updateScanSheet(string $ref, string $description): array
    {
        $this->methodProperties = [];

        $this->calledMethod = 'updateScanSheet';
        $this->methodProperties['Ref'] = $ref;
        $this->methodProperties['Description'] = $description;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
