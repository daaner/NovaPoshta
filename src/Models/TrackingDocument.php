<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class TrackingDocument extends NovaPoshta
{
    protected $model = 'TrackingDocument';
    protected $calledMethod;

    /**
     * Получение полной информации по ТТН/ТТНкам.
     * @see https://developers.novaposhta.ua/view/model/a99d2f28-8512-11ec-8ced-005056b2dbe1/method/a9ae7bc9-8512-11ec-8ced-005056b2dbe1
     *
     * @param string|array $documents
     * @return array
     */
    public function getStatusDocuments($documents): array
    {
        $this->calledMethod = 'getStatusDocuments';

        if (is_array($documents) === false) {
            $documents = explode(', ', /** @scrutinizer ignore-type */ $documents);
        }
        $methodProperties = [
            'Documents' => $documents,
        ];

        return $this->getResponse($this->model, $this->calledMethod, $methodProperties, false);
    }

    /**
     * Проверка единичной ТТН или массива. Телефон, если указан, подставляется один для всех.
     *
     * @param string|array $ttns Номер ТТН либо массив ТТНок
     * @param string|null $phone Номер телефона получателя или отправителя
     * @return array
     */
    public function checkTTN($ttns, ?string $phone = null): array
    {
        $documents = [];

        if (is_array($ttns)) {
            $docs = array_values($ttns);
            foreach ($docs as $key => $ttn) {
                $documents[$key]['DocumentNumber'] = $this->clearNumber($ttn);
                $documents[$key]['Phone'] = $phone;
            }
        } else {
            $documents[0]['DocumentNumber'] = $this->clearNumber($ttns);
            $documents[0]['Phone'] = $phone;
        }

        return $this->getStatusDocuments($documents);
    }

    /**
     * Получение статусов одной ТТН или массива.
     *
     * @param string|array $ttns
     * @param string|int|null $phone
     * @return array
     */
    public function getStatusTTN($ttns, $phone = null): array
    {
        $answer = $this->checkTTN($ttns, $phone);
        $statuses = [];

        if ($answer['success'] && ! empty($answer['result'])) {
            foreach ($answer['result'] as $key => $status) {
                $statuses[$key]['Number'] = $status['Number'];
                $statuses[$key]['StatusCode'] = $status['StatusCode'];
                $statuses[$key]['Status'] = $status['Status'];
                $statuses[$key]['StatusLocale'] = trans('novaposhta::novaposhta.statusCode.'.$status['StatusCode']);
                $statuses[$key]['ActualDeliveryDate'] = $status['ActualDeliveryDate'] ?? null;

                $statuses[$key]['NewTTN'] = '';
                $statuses[$key]['NewMoneyTTN'] = '';

                // Проверка на существование поля обратной доставки и получения номера накладной
                // если присутствует тире в номере - значит это отправка денег назад
                // если длина значения > 11 - это номер возврата денег. Поэтому проверка четко на 11 символов
                if (isset($status['LastCreatedOnTheBasisNumber']) && $status['LastCreatedOnTheBasisNumber']) {
                    if (strripos($status['LastCreatedOnTheBasisNumber'], '-')) {
                        $statuses[$key]['NewMoneyTTN'] = $status['LastCreatedOnTheBasisNumber'];
                    } else {
                        $statuses[$key]['NewTTN'] = $status['LastCreatedOnTheBasisNumber'];
                    }
                }

//                $statuses[$key]['NewTTN'] = isset($status['LastCreatedOnTheBasisNumber'])
//                    && $status['LastCreatedOnTheBasisNumber']
//                    && strlen($status['LastCreatedOnTheBasisNumber']) > 10 ? $status['LastCreatedOnTheBasisNumber'] : null;
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

    /**
     * Очистка пробелов и букв в ТТН
     *
     * @param string $ttn
     * @return string
     */
    public function clearNumber(string $ttn): string
    {
        return preg_replace('/[^0-9,]/', '', $ttn);
    }
}
