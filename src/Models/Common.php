<?php

namespace Daaner\NovaPoshta\Models;

use Carbon\Carbon;
use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\CommonFilter;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\Limit;

class Common extends NovaPoshta
{
    use Limit, CommonFilter, DateTimes;

    protected $model = 'Common';
    protected $calledMethod;
    protected $methodProperties = null;

    /**
     * Справочник форм собственности.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a754ff0d-8512-11ec-8ced-005056b2dbe1 Справочник форм собственности
     * @since 2022-11-07
     *
     * @return array
     */
    public function getOwnershipFormsList(): array
    {
        $this->calledMethod = 'getOwnershipFormsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника формы оплаты.
     * Работает без авторизации.
     *
     * @since 2022-11-07 НЕ ДОКУМЕНТИРОВАНО
     *
     * @return array
     */
    public function getPaymentForms(): array
    {
        $this->calledMethod = 'getPaymentForms';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника типов контрагентов.
     * Работает без авторизации.
     *
     * @since 2022-11-07 НЕ ДОКУМЕНТИРОВАНО
     *
     * @return array
     */
    public function getTypesOfCounterparties(): array
    {
        $this->calledMethod = 'getTypesOfCounterparties';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника технологий доставки.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6e189f7-8512-11ec-8ced-005056b2dbe1 Получение справочника технологий доставки
     * @since 2022-11-07
     *
     * @return array
     */
    public function getServiceTypes(): array
    {
        $this->calledMethod = 'getServiceTypes';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника описаний груза.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a697db47-8512-11ec-8ced-005056b2dbe1 Получение справочника описаний груза
     * @since 2022-11-07
     *
     * @param  string|null  $find  Запрос поиска
     * @return array
     */
    public function getCargoDescriptionList(?string $find = null): array
    {
        $this->calledMethod = 'getCargoDescriptionList';
        $this->getPage();

        if ($find) {
            $this->methodProperties['FindByString'] = $find;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов шин и дисков.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a66fada0-8512-11ec-8ced-005056b2dbe1 Получение справочника видов шин и дисков
     * @since 2022-11-07
     *
     * @return array
     */
    public function getTiresWheelsList(): array
    {
        $this->calledMethod = 'getTiresWheelsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов упаковки.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6492db4-8512-11ec-8ced-005056b2dbe1 Получение справочника видов упаковки
     * @since 2022-11-07
     *
     * @return array
     */
    public function getPackList(): array
    {
        $this->calledMethod = 'getPackList';

        $this->getLength();
        $this->getWidth();
        $this->getHeight();
        $this->getVolumetricWeight();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов плательщиков обратной доставки.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1 Получение справочника видов плательщиков обратной доставки
     * @since 2022-11-07
     *
     * @return array
     */
    public function getTypesOfPayersForRedelivery(): array
    {
        $this->calledMethod = 'getTypesOfPayersForRedelivery';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов плательщиков доставки.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1 Получение справочника видов плательщиков доставки
     * @since 2022-11-07
     *
     * @return array
     */
    public function getTypesOfPayers(): array
    {
        $this->calledMethod = 'getTypesOfPayers';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов паллет.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5dd575e-8512-11ec-8ced-005056b2dbe1 Получение справочника видов паллет
     * @since 2022-11-07
     *
     * @return array
     */
    public function getPalletsList(): array
    {
        $this->calledMethod = 'getPalletsList';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов обратной доставки груза.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5b46873-8512-11ec-8ced-005056b2dbe1 Получение справочника видов обратной доставки груза
     * @since 2022-11-07
     *
     * @return array
     */
    public function getBackwardDeliveryCargoTypes(): array
    {
        $this->calledMethod = 'getBackwardDeliveryCargoTypes';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов груза.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5912a1e-8512-11ec-8ced-005056b2dbe1 Получение справочника видов груза
     * @since 2022-11-07
     *
     * @return array
     */
    public function getCargoTypes(): array
    {
        $this->calledMethod = 'getCargoTypes';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение справочника видов временных интервалов.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a56d5c1c-8512-11ec-8ced-005056b2dbe1 Получение справочника видов временных интервалов
     * @since 2022-11-07
     *
     * @param  string  $recipientCityRef  Ref города
     * @param  string|Carbon|null  $dateTime  Дата интервалов
     * @return array
     */
    public function getTimeIntervals(string $recipientCityRef, $dateTime = null): array
    {
        $this->calledMethod = 'getTimeIntervals';

        $this->methodProperties['RecipientCityRef'] = $recipientCityRef;

        if ($dateTime && $newDate = $this->checkDate($dateTime)) {
            $this->methodProperties['DateTime'] = $newDate;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение данных о персональном менеджере.
     *
     * @since 2022-11-05
     *
     * @param  string  $Ref  Ref контрагента
     * @return array
     */
    public function getPersonalManager(string $Ref): array
    {
        $this->calledMethod = 'getPersonalManager';

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
