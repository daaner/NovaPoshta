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
     * Загрузить список контрагентов отправителей / получателей / третье лицо.
     *
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a37a06df-8512-11ec-8ced-005056b2dbe1 Загрузить список контрагентов
     * @since 2022-11-03
     *
     * @param  string|null  $find  Поиск по названию
     * @return array
     */
    public function getCounterparties(?string $find = null): array
    {
        $this->calledMethod = 'getCounterparties';
        $this->getPage();
        $this->getLimit();

        $this->getCounterpartyProperty();

        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Загрузить список контактных лиц Контрагента.
     *
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a3575a67-8512-11ec-8ced-005056b2dbe1 Загрузить список контактных лиц Контрагента
     * @since 2022-11-06
     *
     * @param  string  $Ref  Ref контрагента
     * @return array
     */
    public function getCounterpartyContactPerson(string $Ref): array
    {
        $this->calledMethod = 'getCounterpartyContactPersons';
        $this->getPage();
        $this->getLimit();

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Создать Контрагента.
     *
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/0ae5dd75-8a5f-11ec-8ced-005056b2dbe1 Создать контрагента с типом Физ лицо
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/bc3c44c7-8a8a-11ec-8ced-005056b2dbe1 Создать контрагента с типом Юр лицо
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/b0fdf818-8a8e-11ec-8ced-005056b2dbe1 Создать контрагента с типом Третья особа
     *
     * @param  string  $firstName  Имя
     * @param  string|null  $lastName  Фамилия
     * @param  string|null  $middleName  Отчество
     * @param  string|int|null  $phone  Телефон
     * @param  string|null  $email  Электронная почта
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
     * Скачать параметры Контрагента.
     *
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a332efbf-8512-11ec-8ced-005056b2dbe1 Скачать параметры Контрагента
     * @since 2022-11-06
     *
     * @param  string  $Ref  Ref контрагента
     * @return array
     */
    public function getCounterpartyOptions(string $Ref): array
    {
        $this->calledMethod = 'getCounterpartyOptions';

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Загрузить список адресов Контрагентов.
     *
     * @see https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a30dbb7c-8512-11ec-8ced-005056b2dbe1 Загрузить список адресов Контрагентов
     * @since 2022-11-06
     *
     * @param  string  $Ref  Ref контрагента
     * @return array
     */
    public function getCounterpartyAddresses(string $Ref): array
    {
        $this->calledMethod = 'getCounterpartyAddresses';
        $this->getCounterpartyProperty();

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение данных об Контрагенте по номеру телефона (ФИО и прочее).
     *
     * @since 2022-11-05 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string|int  $Phone  Телефон
     * @param  string  $LastName  Фамилия (минимум 3 буквы)
     * @return array
     */
    public function getCatalogCounterparty($Phone, string $LastName): array
    {
        $this->calledMethod = 'getCatalogCounterparty';

        $this->methodProperties['Phone'] = $Phone;
        $this->methodProperties['LastName'] = $LastName;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
