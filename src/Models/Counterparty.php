<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\CounterpartyProperty;
use Daaner\NovaPoshta\Traits\Limit;

class Counterparty extends NovaPoshta
{
    use Limit, CounterpartyProperty;

    protected $model = 'Counterparty';
    protected $calledMethod;
    protected $methodProperties = [];

    public function getCounterparties($counterpartyProperty = null, $find = null)
    {
        $this->calledMethod = 'getCounterparties';
        $this->getPage();
        $this->addLimit();

        //Sender or Recipient
        if (! $counterpartyProperty) {
            $counterpartyProperty = 'Sender';
        }

        $this->methodProperties['CounterpartyProperty'] = $counterpartyProperty;
        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getCounterpartyContactPerson($ref)
    {
        $this->calledMethod = 'getCounterpartyContactPersons';
        $this->getPage();
        $this->addLimit();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function save($lastName, $firstName, $middleName, $phone, $email = null)
    {
        $this->calledMethod = 'save';
        $this->getCounterpartyType();
        $this->getCounterpartyProperty();

        $this->methodProperties['LastName'] = $lastName;
        $this->methodProperties['FirstName'] = $firstName;
        $this->methodProperties['MiddleName'] = $middleName;
        $this->methodProperties['Phone'] = $phone;
        $this->methodProperties['Email'] = $email;

        // dd($this->methodProperties);
        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
