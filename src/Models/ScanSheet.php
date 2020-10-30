<?php

namespace Daaner\NovaPoshta\Models;

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
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6a2da0fe4f08e8f7ce2f
     *
     * @param string|array $ScanSheetRefs
     * @return array
     */
    public function deleteScanSheet($ScanSheetRefs)
    {
        $this->calledMethod = 'deleteScanSheet';

        if (is_array($ScanSheetRefs) === false) {
            $ScanSheetRefs = explode(', ', /** @scrutinizer ignore-type */ $ScanSheetRefs);
        }

        $this->methodProperties['ScanSheetRefs'] = array_values(/** @scrutinizer ignore-type */ $ScanSheetRefs);

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c4786a0fe4f0634657b65
     *
     * @param string|array $DocumentRefs
     * @param string|null $Ref
     * @param string|Carbon|null $Date
     * @return array
     */
    public function insertDocuments($DocumentRefs, $Ref = null, $Date = null)
    {
        $this->calledMethod = 'insertDocuments';

        if (is_array($DocumentRefs) === false) {
            $DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
        }

        $this->methodProperties['DocumentRefs'] = array_values(/** @scrutinizer ignore-type */ $DocumentRefs);

        if ($Ref) {
            $this->methodProperties['Ref'] = $Ref;
        }

        if ($Date) {
            $this->methodProperties['Date'] = $this->checkDate($Date);
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c7734a0fe4f08e8f7ce31
     *
     * @return array
     */
    public function getScanSheetList()
    {
        $this->calledMethod = 'getScanSheetList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c72d7a0fe4f08e8f7ce30
     *
     * @param string $ref
     * @return array
     */
    public function getScanSheet($ref)
    {
        $this->calledMethod = 'getScanSheet';

        $this->methodProperties = [];
        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6474a0fe4f08e8f7ce2e
     *
     * @param string|array $documents
     * @param string|null $ref
     * @return array
     */
    public function removeDocuments($documents, $ref = null)
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
     * Не документировано.
     *
     * @param string $ref
     * @return array
     */
    public function getScanSheetDocuments($ref)
    {
        $this->methodProperties = [];
        $this->getPage();
        $this->addLimit();

        $this->calledMethod = 'getScanSheetDocuments';
        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Не документировано.
     *
     * @param string $ref
     * @param string|int $description
     * @return array
     */
    public function updateScanSheet($ref, $description)
    {
        $this->methodProperties = [];

        $this->calledMethod = 'updateScanSheet';
        $this->methodProperties['Ref'] = $ref;
        $this->methodProperties['Description'] = $description;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
