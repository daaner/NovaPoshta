<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class TrackingDocument extends NovaPoshta
{
    protected $model = 'TrackingDocument';
    protected $calledMethod;

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
     *
     * @param string|array $documents
     * @return array
     */
    public function getStatusDocuments($documents)
    {
        $this->calledMethod = 'getStatusDocuments';

        if (is_array($documents) === false) {
            $documents = explode(' ', /** @scrutinizer ignore-type */ $documents);
        }
        $methodProperties = [
            'Documents' => $documents,
        ];

        return $this->getResponse($this->model, $this->calledMethod, $methodProperties, false);
    }

    /**
     * Проверка еденичной ТТН или массива. Телефон, если указан, подставляется один для всех.
     *
     * Номер ТТН либо массив ТТНок
     * @param string|array $ttn
     * Номер телефона получателя или отправителя
     * @param string|null $phone
     * @return array
     */
    public function checkTTN($ttns, $phone = null)
    {
        $documents = [];

        if (is_array($ttns)) {
            foreach ($ttns as $key => $ttn) {
                $documents[$key]['DocumentNumber'] = $ttn;
                $documents[$key]['Phone'] = $phone;
            }
        } else {
            $documents[0]['DocumentNumber'] = $ttns;
            $documents[0]['Phone'] = $phone;
        }

        return $this->getStatusDocuments($documents);
    }

    /**
     * Получение статусов одной ТТН или массива.
     *
     * @param string|array $ttn
     * @return array
     */
    public function getStatusTTN($ttns, $phone = null)
    {
        $answer = $this->checkTTN($ttns, $phone);
        $statuses = [];

        if ($answer['success'] && ! empty($answer['result'])) {
            foreach ($answer['result'] as $key => $status) {
                $statuses[$key]['Number'] = $status['Number'];
                $statuses[$key]['StatusCode'] = $status['StatusCode'];
                $statuses[$key]['Status'] = $status['Status'];
                $statuses[$key]['StatusLocale'] = trans('novaposhta::novaposhta.statusCode.'.$status['StatusCode']);
                $statuses[$key]['ActualDeliveryDate'] = isset($status['ActualDeliveryDate']) ? $status['ActualDeliveryDate'] : null;

                // проверка на существование поля обратной доставки и получения номера накладной
                // если длина значения > 11 - это номер возврата денег. ПОэтому проверка четко на 11 символов
                $statuses[$key]['NewTTN'] = isset($status['LastCreatedOnTheBasisNumber']) && $status['LastCreatedOnTheBasisNumber'] && strlen($status['LastCreatedOnTheBasisNumber']) == 11 ? $status['LastCreatedOnTheBasisNumber'] : null;
            }
        }

        $return = [
            'success' => $answer['success'],
            'result' => $statuses,
            'info' => $answer['info'],
        ];

        if (isset($answer['dev'])) {
            $return['dev'] = $answer['dev'];
        }

        return $return;
    }
}
