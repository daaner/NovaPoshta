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
    protected $methodProperties = [];

    use InternetDocumentProperty, AdditionalServiceProperty, Limit, DateTimes;

    /**
     * Проверка возможности создания заявки на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1 Возможность возврата
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function CheckPossibilityCreateReturn(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityCreateReturn';

        $this->methodProperties['Number'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Проверка возможности создания заявки на переадресацию отправки.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8d29fc2-8512-11ec-8ced-005056b2dbe1 Возможность переадресации
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function checkPossibilityForRedirecting(string $ttn): array
    {
        $this->calledMethod = 'checkPossibilityForRedirecting';

        $this->methodProperties['Number'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка причин возврата.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7a6bacb-8512-11ec-8ced-005056b2dbe1 Список причин возврата
     *
     * @return array
     */
    public function getReturnReasons(): array
    {
        $this->calledMethod = 'getReturnReasons';

        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка подтипов причины возврата.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1 Список подтипов причины возврата
     *
     * @param  string|null  $ref  Ref причины
     * @return array
     */
    public function getReturnReasonsSubtypes(?string $ref = null): array
    {
        $this->calledMethod = 'getReturnReasonsSubtypes';

        $this->methodProperties['ReasonRef'] = $ref ?: config('novaposhta.ref_return_reasons');

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка заявок на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1 Список заявок на возврат
     *
     * @return array
     */
    public function getReturnOrdersList(): array
    {
        $this->calledMethod = 'getReturnOrdersList';

        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Получение списка заявок на переадресацию отправлений.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8faa2e6-8512-11ec-8ced-005056b2dbe1 Список заявок на переадресацию
     *
     * @return array
     */
    public function getRedirectionOrdersList(): array
    {
        $this->calledMethod = 'getRedirectionOrdersList';

        $this->methodProperties = null;

        $this->addLimit();
        $this->getPage();

        $this->getNumber();
        $this->getDateBeginEnd();

        if ($this->Ref) {
            $this->methodProperties['Ref'] = $this->Ref;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Создание заявки на возврат.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7fb4a3a-8512-11ec-8ced-005056b2dbe1 Возврат на адрес отправителя
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/5a64f960-e7fa-11ec-a60f-48df37b921db Возврат на новый адрес отделения
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/175baec3-8f0d-11ec-8ced-005056b2dbe1 Возврат на новый адрес по адресной доставке
     *
     * @param  string  $ttn  Номер ТТН
     * @param  bool|null  $isRedirecting  Флаг, что заявка является переадресацией
     * @return array
     */
    public function save(string $ttn, ?bool $isRedirecting = false): array
    {
        $this->calledMethod = 'save';

        $this->methodProperties['IntDocNumber'] = $ttn;

        $this->getPaymentMethod();
        $this->getNote();

        /**
         * Переадресация или возврат
         */
        if ($isRedirecting) {
            $this->methodProperties['OrderType'] = 'orderRedirecting';
            $this->getPayerType();
            $this->getCustomer();
            $this->getServiceType();
            $this->getRecipientData();
        } else {
            $this->methodProperties['OrderType'] = 'orderCargoReturn';

            // При возврате нужно указать причину и подтип причины
            $this->getReason();
            $this->getSubtypeReason();

            /**
             * Возврат/переадресация на адрес отправления.
             */
            $this->getReturnAddressRef();
        }

        if (! $this->Note) {
            $this->methodProperties['Note'] = config('novaposhta.return_note');

            if ($isRedirecting) {
                $this->methodProperties['Note'] = config('novaposhta.redirecting_note');
            }
        }

        /**
         * Возврат/переадресация на новый адрес отделения.
         */
        $this->getRecipientWarehouse();

        /**
         * Возврат/переадресация на новый адрес по адресной доставке.
         */
        $this->getRecipientSettlement();

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Создание заявки на переадресацию.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/98acb0f6-8f0b-11ec-8ced-005056b2dbe1 Создание заявки на переадресацию
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function saveRedirecting(string $ttn): array
    {
        return $this->save($ttn, true);
    }

    /**
     * Удаление заявки на возврат, заявку об изменении данных или заявку переадресации.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a85bb34b-8512-11ec-8ced-005056b2dbe1 Удаление заявки
     *
     * @param  string  $Ref  Ref заявки
     * @return array
     */
    public function delete(string $Ref): array
    {
        $this->calledMethod = 'delete';

        $this->methodProperties['Ref'] = $Ref;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    /**
     * Проверка продления хранения ТТН.
     *
     * @param  string  $ttn  Номер ТТН
     * @return array
     */
    public function CheckPossibilityTermExtension(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityTermExtension';

        $this->methodProperties['IntDocNumber'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }


    /**
     * Проверка на изменения в ТТН.
     *
     * @see https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a886b776-8512-11ec-8ced-005056b2dbe1 Проверка на изменения в накладной
     *
     * @param string $ttn Номер ТТН
     * @return array
     */
    public function CheckPossibilityChangeEW(string $ttn): array
    {
        $this->calledMethod = 'CheckPossibilityChangeEW';

        $this->methodProperties['IntDocNumber'] = $ttn;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }
}
