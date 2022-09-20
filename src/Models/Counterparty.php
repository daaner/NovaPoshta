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
     * @param  string|null  $find
     * @return array
     */
    public function getCounterparties(?string $find): array
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
     * @param  string  $ref
     * @return array
     */
    public function getCounterpartyContactPerson(string $ref): array
    {
        $this->calledMethod = 'getCounterpartyContactPersons';
        $this->getPage();
        $this->addLimit();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param  string  $firstName
     * @param  string|null  $lastName
     * @param  string|null  $middleName
     * @param  string|int|null  $phone
     * @param  string|null  $email
     * @return array
     */
    public function save(
        string $firstName,
        ?string $lastName = null,
        ?string $middleName = null,
        $phone = null,
        ?string $email = null
    ): array {
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
     * @param  string  $ref
     * @return array
     */
    public function getCounterpartyOptions(string $ref): array
    {
        $this->calledMethod = 'getCounterpartyOptions';

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param  string  $ref
     * @return array
     */
    public function getCounterpartyAddresses(string $ref): array
    {
        $this->calledMethod = 'getCounterpartyAddresses';
        $this->getCounterpartyProperty();

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * @param  string|int  $phone
     * @param  string  $lastname
     * @return array
     */
    public function getCatalogCounterparty($phone, string $lastname): array
    {
        $this->calledMethod = 'getCatalogCounterparty';

        $this->methodProperties['Phone'] = $phone;
        $this->methodProperties['LastName'] = $lastname;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
