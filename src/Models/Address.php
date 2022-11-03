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
     * @param  string|null  $find  Строка или Ref поиска
     * @param  bool|null  $searchByString  Поиск по Ref = false или по строке
     * @return array
     */
    public function getCities(?string $find = null, ?bool $searchByString = true): array
    {
        $this->calledMethod = 'getCities';
        $this->getLimit();
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
     * @param  string|null  $cityRef  Строка или Ref поиска
     * @param  bool|null  $searchByString  Поиск по Ref = false или по строке
     * @return array
     */
    public function getWarehouses(?string $cityRef = null, ?bool $searchByString = true): array
    {
        $this->calledMethod = 'getWarehouses';
        $this->getLimit();
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
     * @param  string  $settlementRef  Ref населенного пункта
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
     * @param  string  $search  Строка поиска
     * @return array
     */
    public function searchSettlements(string $search): array
    {
        $this->calledMethod = 'searchSettlements';
        $this->getLimit();
        $this->getPage();

        $this->methodProperties['CityName'] = $search;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Поиск улиц в населенных пунктах.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1329635-8512-11ec-8ced-005056b2dbe1 Поиск улиц в населенных пунктах
     *
     * @param  string  $ref  Ref
     * @param  string  $street  Поиск улицы (минимум 2 буквы)
     * @return array
     */
    public function searchSettlementStreets(string $ref, string $street): array
    {
        $this->calledMethod = 'searchSettlementStreets';
        $this->getLimit();

        $this->methodProperties['SettlementRef'] = $ref;
        $this->methodProperties['StreetName'] = $street;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Справочник населенных пунктов Украины.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1c42723-8512-11ec-8ced-005056b2dbe1 Справочник населенных пунктов
     *
     * @param  string|null  $find  Строка поиска
     * @return array
     */
    public function getSettlements(?string $find = null): array
    {
        $this->calledMethod = 'getSettlements';
        $this->methodProperties = null;

        /**
         * TODO Лимит установлен хардкорно
         * $this->getLimit();.
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
     * @param  string  $cityRef  Ref города
     * @param  string|null  $find  Строка поиска
     * @return array
     */
    public function getStreet(string $cityRef, ?string $find = null): array
    {
        $this->calledMethod = 'getStreet';
        $this->getLimit();
        $this->getPage();

        $this->methodProperties['CityRef'] = $cityRef;
        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Создать адрес контрагента (отправитель / получатель).
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a155d0d9-8512-11ec-8ced-005056b2dbe1 Создать адрес контрагента
     * @deprecated НЕ СДЕЛАНО
     *
     * TODO Не сделано
     *
     * @return false
     */
    public function save()
    {
        $this->calledMethod = 'save';

        return false;
    }

    /**
     * Редактировать адрес контрагента (отправитель / получатель).
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a19ba934-8512-11ec-8ced-005056b2dbe1 Редактировать адрес контрагента
     * @deprecated НЕ СДЕЛАНО
     *
     * TODO Не сделано
     *
     * @return false
     */
    public function update()
    {
        $this->calledMethod = 'update';

        return false;
    }

    /**
     * Удалить адрес контрагента (отправитель / получатель).
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a177069a-8512-11ec-8ced-005056b2dbe1 Удалить адрес контрагента
     * @deprecated НЕ СДЕЛАНО
     *
     * TODO Не сделано
     *
     * @return false
     */
    public function delete()
    {
        $this->calledMethod = 'delete';

        return false;
    }
}
