<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\AdditionalServiceProperty;
use Daaner\NovaPoshta\Traits\DateTimes;
use Daaner\NovaPoshta\Traits\InternetDocumentProperty;
use Daaner\NovaPoshta\Traits\Limit;

class AdditionalService extends NovaPoshta
{
    protected $model = 'AdditionalService';
    protected $calledMethod;
    protected $methodProperties = null;
    protected $BackwardRedeliveryString;

    use InternetDocumentProperty, AdditionalServiceProperty, Limit, DateTimes;

    /**
     * Проверка возможности создания заявки на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1 Возможность возврата
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function CheckPossibilityCreateReturn(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityCreateReturn';

        $this->methodProperties['Number'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Проверка возможности создания заявки на переадресацию отправки.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8d29fc2-8512-11ec-8ced-005056b2dbe1 Возможность переадресации
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function checkPossibilityForRedirecting(string $ttn): array
    {
        $this->calledMethod = 'checkPossibilityForRedirecting';

        $this->methodProperties['Number'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение списка причин возврата.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7a6bacb-8512-11ec-8ced-005056b2dbe1 Список причин возврата
     * @since 2022-11-06
     *
     * @return array
     */
    public function getReturnReasons(): array
    {
        $this->calledMethod = 'getReturnReasons';

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение списка подтипов причины возврата.
     * Работает без авторизации.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1 Список подтипов причины возврата
     * @since 2022-11-06
     *
     * @param  string|null  $ref  Ref причины
     * @return array
     */
    public function getReturnReasonsSubtypes(?string $ref = null): array
    {
        $this->calledMethod = 'getReturnReasonsSubtypes';

        $this->methodProperties['ReasonRef'] = $ref ?: config('novaposhta.ref_return_reasons');

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, false);
    }

    /**
     * Получение списка заявок на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1 Список заявок на возврат
     * @since 2022-11-06
     *
     * @return array
     */
    public function getReturnOrdersList(): array
    {
        $this->calledMethod = 'getReturnOrdersList';

        $this->getLimit();
        $this->getPage();
        $this->getDateBeginEnd();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Получение списка заявок на переадресацию отправлений.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8faa2e6-8512-11ec-8ced-005056b2dbe1 Список заявок на переадресацию
     * @since 2022-11-06
     *
     * @return array
     */
    public function getRedirectionOrdersList(): array
    {
        $this->calledMethod = 'getRedirectionOrdersList';

        $this->methodProperties = null;

        $this->getLimit();
        $this->getPage();

        $this->getNumber();
        $this->getDateBeginEnd();

        if ($this->Ref) {
            $this->methodProperties['Ref'] = $this->Ref;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Создание заявки на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7fb4a3a-8512-11ec-8ced-005056b2dbe1 Возврат на адрес отправителя
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/5a64f960-e7fa-11ec-a60f-48df37b921db Возврат на новый адрес отделения
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/175baec3-8f0d-11ec-8ced-005056b2dbe1 Возврат на новый адрес по адресной доставке
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @param  string|null  $ownerDocumentType  Тип документа
     * @return array
     */
    public function save(string $ttn, ?string $ownerDocumentType = 'orderCargoReturn'): array
    {
        $this->calledMethod = 'save';

        $this->methodProperties['IntDocNumber'] = $ttn;

        $this->getPaymentMethod();
        $this->getNote();

        $this->methodProperties['OrderType'] = $ownerDocumentType;

        /**
         * ========================
         * Тип оформления
         * ========================.
         */
        // Обычный возврат
        if ($ownerDocumentType == 'orderCargoReturn') {
            // При возврате нужно указать причину и подтип причины
            $this->getReason();
            $this->getSubtypeReason();

            /**
             * Возврат/переадресация на адрес отправления.
             */
            $this->getReturnAddressRef();

            if (! $this->Note) {
                $this->methodProperties['Note'] = config('novaposhta.redirecting_note');
            }
        }

        // Переадресация
        if ($ownerDocumentType == 'orderRedirecting') {
            $this->getPayerType();
            $this->getCustomer();
            $this->getServiceType();
            $this->getRecipientData();

            if (! $this->Note) {
                $this->methodProperties['Note'] = config('novaposhta.return_note');
            }
        }

        // Продление хранения
        if ($ownerDocumentType == 'orderTermExtension') {
            $this->getPayerType();
            $this->getStorageFinalDate();
        }

        // Замена наложного платежа
        if ($ownerDocumentType == 'orderChangeEW') {
            $this->methodProperties['PayerType'] = 'Recipient';

            if ($this->BackwardRedeliveryString) {
                $this->methodProperties['BackwardDeliveryData'][] = [
                    'PayerType' => 'Recipient',
                    'CargoType' => 'Money',
                    'Description' => $this->BackwardRedeliveryString,
                ];
            } else {
                $this->methodProperties['BackwardDeliveryData'] = [];
            }
        }

        // Доп поля, если переадресация / возврат
        if ($ownerDocumentType == 'orderCargoReturn' || $ownerDocumentType == 'orderRedirecting') {
            /**
             * Возврат/переадресация на новый адрес отделения.
             */
            $this->getRecipientWarehouse();

            /**
             * Возврат/переадресация на новый адрес по адресной доставке.
             */
            $this->getRecipientSettlement();
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Создание заявки на переадресацию.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/98acb0f6-8f0b-11ec-8ced-005056b2dbe1 Создание заявки на переадресацию
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function saveRedirecting(string $ttn): array
    {
        return $this->save($ttn, 'orderRedirecting');
    }

    /**
     * Продление хранения посылки.
     *
     * @since 2022-11-07
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function saveAddTerm(string $ttn): array
    {
        return $this->save($ttn, 'orderTermExtension');
    }

    /**
     * Замена/снятие наложного платежа.
     *
     * @param string $ttn Номер ТТН
     * @param string|null $RedeliveryString Новая сумма или null, чтоб снять наложку
     * @return array
     * @since 2022-11-07
     *
     */
    public function saveChangeCash(string $ttn, ?string $RedeliveryString): array
    {
        $this->BackwardRedeliveryString = $RedeliveryString;

        return $this->save($ttn, 'orderChangeEW');
    }

    /**
     * Удаление заявки на возврат, заявку об изменении данных или заявку переадресации.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a85bb34b-8512-11ec-8ced-005056b2dbe1 Удаление заявки
     * @since 2022-11-06
     *
     * @param  string  $Ref  Ref заявки
     * @return array
     */
    public function delete(string $Ref): array
    {
        $this->calledMethod = 'delete';

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Проверка продления хранения ТТН.
     *
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function CheckPossibilityTermExtension(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityTermExtension';

        $this->methodProperties['IntDocNumber'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }

    /**
     * Проверка на изменения в ТТН.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a886b776-8512-11ec-8ced-005056b2dbe1 Проверка на изменения в накладной
     * @since 2022-11-06
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function CheckPossibilityChangeEW(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityChangeEW';

        $this->methodProperties['IntDocNumber'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties, true);
    }
}
