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
     * Завантажити список контрагентів відправників / одержувачів / третя особа
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a37a06df-8512-11ec-8ced-005056b2dbe1
     *
     * @param string|null $find
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
     * Завантажити список контактних осіб Контрагента
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a3575a67-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref
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
     * Створити Контрагента
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/0ae5dd75-8a5f-11ec-8ced-005056b2dbe1
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/bc3c44c7-8a8a-11ec-8ced-005056b2dbe1
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/b0fdf818-8a8e-11ec-8ced-005056b2dbe1
     *
     * @param string $firstName
     * @param string|null $lastName
     * @param string|null $middleName
     * @param string|int|null $phone
     * @param string|null $email
     * @return array
     */
    public function save(
        string $firstName,
        ?string $lastName = null,
        ?string $middleName = null,
        $phone = null,
        ?string $email = null
    ): array
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
     * Завантажити параметри Контрагента
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a332efbf-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref
     * @return array
     */
    public function getCounterpartyOptions(string $ref): array
    {
        $this->calledMethod = 'getCounterpartyOptions';

        $this->methodProperties['Ref'] = $ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Завантажити список адрес Контрагентів
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a30dbb7c-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref
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
     * Получение данных об Контрагенте по номеру телефона (ФИО и прочее)
     *
     * @param string|int $phone
     * @param string $lastname
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
