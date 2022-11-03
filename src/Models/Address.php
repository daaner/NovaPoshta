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
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a20ee6e4-8512-11ec-8ced-005056b2dbe1 Получение списка областей
     * @since 2022-11-03
     *
     * @return array
     */
    public function getAreas(): array
    {
        $this->calledMethod = 'getAreas';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение списка городов.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1e6f0a7-8512-11ec-8ced-005056b2dbe1 Получение списка городов
     * @since 2022-11-03
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

        /**
         * Если значения пустые - вставляем насильно.
         */
        if (! $this->limit) {
            $this->methodProperties['Limit'] = config('novaposhta.page_limit');
        }

        if ($find) {
            if ($searchByString) {
                $this->methodProperties['FindByString'] = $find;
            } else {
                $this->methodProperties['Ref'] = $find;
            }
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение списка отделений и почтоматов в городах.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2322f38-8512-11ec-8ced-005056b2dbe1 Получение списка отделений и почтоматов в городах
     * @since 2022-11-03
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

        /**
         * Если значения пустые - вставляем насильно.
         */
        if (! $this->limit) {
            $this->methodProperties['Limit'] = config('novaposhta.page_limit');
        }

        if ($cityRef) {
            if ($searchByString) {
                $this->methodProperties['CityName'] = $cityRef;
            } else {
                $this->methodProperties['CityRef'] = $cityRef;
            }
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение типов отделений.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2587b53-8512-11ec-8ced-005056b2dbe1 Получение типов отделений
     * @since 2022-11-03
     *
     * @return array
     */
    public function getWarehouseTypes(): array
    {
        $this->calledMethod = 'getWarehouseTypes';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение списка отделений в населенном пункте.
     * Работает без авторизации.
     *
     * @since 2022-11-03 НЕ ДОКУМЕНТИРОВАНО
     *
     * @param  string  $settlementRef  Ref населенного пункта
     * @return array
     */
    public function getWarehouseSettlements(string $settlementRef): array
    {
        $this->calledMethod = 'getWarehouses';
        $this->getTypeOfWarehouseRef();

        $this->methodProperties['SettlementRef'] = $settlementRef;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Поиск населенных пунктов из справочника Settlements.
     * Не стандартная выдача ответа!!!
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a0eb83ab-8512-11ec-8ced-005056b2dbe1 Поиск населенных пунктов
     * @since 2022-11-03
     *
     * @param  string  $search  Строка поиска
     * @return array
     */
    public function searchSettlements(string $search): array
    {
        $this->calledMethod = 'searchSettlements';
        $this->getLimit();

        $this->methodProperties['CityName'] = $search;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Поиск улиц в населенных пунктах.
     * Не стандартная выдача ответа!!!
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1329635-8512-11ec-8ced-005056b2dbe1 Поиск улиц в населенных пунктах
     * @since 2022-11-03
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

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение улиц в городе по CityRef.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a27c20d7-8512-11ec-8ced-005056b2dbe1 Получение улиц в городе
     * @since 2022-11-03
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

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Справочник населенных пунктов Украины.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1c42723-8512-11ec-8ced-005056b2dbe1 Справочник населенных пунктов
     * @since 2022-11-03
     *
     * @param  string|null  $find  Строка поиска
     * @return array
     */
    public function getSettlements(?string $find = null): array
    {
        $this->calledMethod = 'getSettlements';

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

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
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
