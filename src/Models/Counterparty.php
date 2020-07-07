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

    public function getCounterparties($find = null)
    {
        $this->calledMethod = 'getCounterparties';
        $this->getPage();
        $this->addLimit();

        $this->getCounterpartyProperty();

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

    public function save($firstName, $lastName = null, $middleName = null, $phone = null, $email = null)
    {
        $this->calledMethod = 'save';
        $this->getCounterpartyType();
        $this->getCounterpartyProperty();
        $this->getOwnershipForm();
        $this->getEDRPOU();

        if ($this->counterpartyProperty !== 'ThirdPerson') {
            $this->methodProperties['FirstName'] = $firstName;
        }

        if ($lastName) {
            $this->methodProperties['LastName'] = $lastName;
        }
        if ($middleName) {
            $this->methodProperties['MiddleName'] = $middleName;
        }
        if ($phone) {
            $this->methodProperties['Phone'] = $phone;
        }
        if ($email) {
            $this->methodProperties['Email'] = $email;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getCounterpartyOptions($ref)
    {
        $this->calledMethod = 'getCounterpartyOptions';

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getCounterpartyAddresses($ref)
    {
        $this->calledMethod = 'getCounterpartyAddresses';
        $this->getCounterpartyProperty();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
