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

    /**
      * @param string|null $find
      * @return array
      */
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

    /**
      * @param string $ref
      * @return array
      */
    public function getCounterpartyContactPerson($ref)
    {
        $this->calledMethod = 'getCounterpartyContactPersons';
        $this->getPage();
        $this->addLimit();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
      * @param string $firstName
      * @param string|null $lastName
      * @param string|null $middleName
      * @param string|int|null $phone
      * @param string|null $email
      * @return array
      */
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

    /**
      * @param string $ref
      * @return array
      */
    public function getCounterpartyOptions($ref)
    {
        $this->calledMethod = 'getCounterpartyOptions';

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
      * @param string $ref
      * @return array
      */
    public function getCounterpartyAddresses($ref)
    {
        $this->calledMethod = 'getCounterpartyAddresses';
        $this->getCounterpartyProperty();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
      * @param string|int $phone
      * @param string $lastname
      * @return array
      */
    public function getCatalogCounterparty($phone, $lastname)
    {
        $this->calledMethod = 'getCatalogCounterparty';

        $this->methodProperties['Phone'] = $phone;
        $this->methodProperties['LastName'] = $lastname;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
