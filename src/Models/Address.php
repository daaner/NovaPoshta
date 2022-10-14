<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\AddressSettlementProperty;
use Daaner\NovaPoshta\Traits\Limit;
use Daaner\NovaPoshta\Traits\WarehousesFilter;

class Address extends NovaPoshta
{
    use Limit, WarehousesFilter, AddressSettlementProperty;

    protected $model = 'Address';
    protected $calledMethod;
    protected $methodProperties = [];

    /**
     * Получение списка областей.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a20ee6e4-8512-11ec-8ced-005056b2dbe1 Получение списка областей
     *
     * @return array
     */
    public function getAreas(): array
    {
        $this->calledMethod = 'getAreas';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка городов.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1e6f0a7-8512-11ec-8ced-005056b2dbe1 Получение списка городов
     *
     * @param  string|null  $find
     * @param  bool|null  $searchByString
     * @return array
     */
    public function getCities(?string $find = null, ?bool $searchByString = true): array
    {
        $this->calledMethod = 'getCities';
        $this->addLimit();
        $this->getPage();

        if ($find) {
            if ($searchByString) {
                $this->methodProperties['FindByString'] = $find;
            } else {
                $this->methodProperties['Ref'] = $find;
            }
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка отделений и почтоматов в городах.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2322f38-8512-11ec-8ced-005056b2dbe1 Получение списка отделений и почтоматов в городах
     *
     * @param  string|null  $cityRef
     * @param  bool|null  $searchByString
     * @return array
     */
    public function getWarehouses(?string $cityRef = null, ?bool $searchByString = true): array
    {
        $this->calledMethod = 'getWarehouses';
        $this->addLimit();
        $this->getPage();
        $this->getTypeOfWarehouseRef();

        if ($cityRef) {
            if ($searchByString) {
                $this->methodProperties['CityName'] = $cityRef;
            } else {
                $this->methodProperties['CityRef'] = $cityRef;
            }
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение типов отделений.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2587b53-8512-11ec-8ced-005056b2dbe1 Получение типов отделений
     *
     * @return array
     */
    public function getWarehouseTypes(): array
    {
        $this->calledMethod = 'getWarehouseTypes';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка отделений в населенном пункте.
     *
     * @deprecated НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string  $settlementRef
     * @return array
     */
    public function getWarehouseSettlements(string $settlementRef): array
    {
        $this->calledMethod = 'getWarehouses';
        $this->getTypeOfWarehouseRef();

        $this->methodProperties['SettlementRef'] = $settlementRef;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Поиск населенных пунктов из справочника Settlements.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a0eb83ab-8512-11ec-8ced-005056b2dbe1 Поиск населенных пунктов
     *
     * @param  string  $search
     * @return array
     */
    public function searchSettlements(string $search): array
    {
        $this->calledMethod = 'searchSettlements';
        $this->addLimit();

        $this->methodProperties['CityName'] = $search;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Поиск улиц в населенных пунктах.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1329635-8512-11ec-8ced-005056b2dbe1 Поиск улиц в населенных пунктах
     *
     * @param  string  $ref
     * @param  string  $street
     * @return array
     */
    public function searchSettlementStreets(string $ref, string $street): array
    {
        $this->calledMethod = 'searchSettlementStreets';
        $this->addLimit();

        $this->methodProperties['SettlementRef'] = $ref;
        $this->methodProperties['StreetName'] = $street;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Справочник населенных пунктов Украины.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1c42723-8512-11ec-8ced-005056b2dbe1 Справочник населенных пунктов
     *
     * @param  string|null  $find
     * @return array
     */
    public function getSettlements(?string $find = null): array
    {
        $this->calledMethod = 'getSettlements';
        $this->methodProperties = null;

        /**
         * TODO Daan
         * $this->addLimit();.
         *
         * Нужен лимит 150, иначе значение totalCount имеет не верный формат
         * Устанавливаю насильно, возможно позже исправят
         */
        $this->methodProperties['Limit'] = 150;

        $this->getPage();

        //add AddressSettlementProperty
        $this->getAreaRef();
        $this->getRegionRef();
        $this->getWarehouse();
        $this->getRef();

        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение улиц в городе по CityRef.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a27c20d7-8512-11ec-8ced-005056b2dbe1 Получение улиц в городе
     *
     * @param  string  $city
     * @param  string|null  $find
     * @return array
     */
    public function getStreet(string $city, ?string $find = null): array
    {
        $this->calledMethod = 'getStreet';
        $this->addLimit();
        $this->getPage();

        $this->methodProperties['CityRef'] = $city;
        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * TODO Не сделано
     * Создать адрес контрагента (отправитель / получатель).
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a155d0d9-8512-11ec-8ced-005056b2dbe1 Создать адрес контрагента
     * @deprecated НЕ СДЕЛАНО
     *
     * @return false
     */
    public function save()
    {
        $this->calledMethod = 'save';

        return false;
    }

    /**
     * TODO Не сделано
     * Редактировать адрес контрагента (отправитель / получатель).
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a19ba934-8512-11ec-8ced-005056b2dbe1 Редактировать адрес контрагента
     * @deprecated НЕ СДЕЛАНО
     *
     * @return false
     */
    public function update()
    {
        $this->calledMethod = 'update';

        return false;
    }

    /**
     * TODO Не сделано
     * Удалить адрес контрагента (отправитель / получатель).
     *
     * @deprecated НЕ СДЕЛАНО
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a177069a-8512-11ec-8ced-005056b2dbe1 Удалить адрес контрагента
     *
     * @return false
     */
    public function delete()
    {
        $this->calledMethod = 'delete';

        return false;
    }
}
