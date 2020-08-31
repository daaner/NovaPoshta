<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\DocumentList;

class InternetDocument extends NovaPoshta
{
    use Limit, DateTimes, DocumentList;

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
        // $this->getFullList();


        // $methodProperties = [
        //     'GetFullList' => 0,
        // ];

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
