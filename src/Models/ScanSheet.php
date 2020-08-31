<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;


class ScanSheet extends NovaPoshta
{
    protected $model = 'ScanSheet';
    protected $calledMethod;
    protected $methodProperties = null;

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
}
