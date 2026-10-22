<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Illuminate\Support\Facades\Lang;

class TrackingDocument extends NovaPoshta
{
    protected $model = 'TrackingDocument';
    protected $calledMethod;

    /**
     * Получение полной информации по ТТН/массиву ТТН.
     *
     * @see https://developers.novaposhta.ua/view/model/a99d2f28-8512-11ec-8ced-005056b2dbe1/method/a9ae7bc9-8512-11ec-8ced-005056b2dbe1
     *
     * @param  string|array  $documents  Номер ТТН либо массив ТТН, либо строкой через запятую
     * @return array
     */
    public function getStatusDocuments($documents): array
    {
        $this->calledMethod = 'getStatusDocuments';

        // Строка / массив строк через запятую (с пробелами или без) -> массив объектов для НП.
        // Элементы-массивы ['DocumentNumber' => ..., 'Phone' => ...] передаются как есть.
        $items = is_array($documents) ? array_values($documents) : [$documents];
        $documents = [];
        foreach ($items as $item) {
            if (is_array($item)) {
                $documents[] = $item;
                continue;
            }
            foreach (explode(',', (string) $item) as $number) {
                $number = $this->clearNumber($number);
                if ($number !== '') {
                    $documents[] = [
                        'DocumentNumber' => $number,
                        'Phone' => null,
                    ];
                }
            }
        }
        $methodProperties = [
            'Documents' => array_values(/** @scrutinizer ignore-type */ $documents),
        ];

        return $this->getResponse($this->model, $this->calledMethod, $methodProperties, false);
    }

    /**
     * Проверка единичной ТТН или массива ТТН.
     * Телефон, если указан, подставляется один для всех.
     *
     * @internal Внутренняя функция для простоты обработки
     *
     * @param  string|array  $ttns  Номер ТТН либо массив ТТН
     * @param  string|null  $phone  Номер телефона получателя или отправителя
     * @return array
     */
    public function checkTTN($ttns, ?string $phone = null): array
    {
        $documents = [];

        // Строка вида "123, 456" тоже разбивается на отдельные ТТН
        $docs = is_array($ttns) ? array_values($ttns) : explode(',', (string) $ttns);

        foreach ($docs as $ttn) {
            $number = $this->clearNumber((string) $ttn);
            if ($number === '') {
                continue;
            }
            $documents[] = [
                'DocumentNumber' => $number,
                'Phone' => $phone,
            ];
        }

        return $this->getStatusDocuments($documents);
    }

    /**
     * Получение коротких статусов одной ТТН или массива.
     *
     * @internal Внутренняя функция для простоты обработки
     *
     * @param  string|array  $ttns  Номер ТТН либо массив ТТН
     * @param  string|int|null  $phone  Номер телефона получателя или отправителя
     * @return array
     */
    public function getStatusTTN($ttns, $phone = null): array
    {
        $answer = $this->checkTTN($ttns, $phone);
        $statuses = [];

        if ($answer['success'] && ! empty($answer['result'])) {
            foreach ($answer['result'] as $key => $status) {
                $statusCode = $status['StatusCode'] ?? '';
                $langKey = 'novaposhta::novaposhta.statusCode.'.$statusCode;

                $statuses[$key]['Number'] = $status['Number'] ?? '';
                $statuses[$key]['StatusCode'] = $statusCode;
                $statuses[$key]['Status'] = $status['Status'] ?? '';
                // Неизвестный статус -> текст от НП вместо ключа перевода
                $statuses[$key]['StatusLocale'] = ($statusCode !== '' && Lang::has($langKey))
                    ? trans($langKey)
                    : $statuses[$key]['Status'];
                $statuses[$key]['ActualDeliveryDate'] = $status['ActualDeliveryDate'] ?? null;

                $statuses[$key]['NewTTN'] = '';
                $statuses[$key]['NewMoneyTTN'] = '';

                // Проверка на существование поля обратной доставки и получения номера накладной
                // если присутствует тире в номере - значит это отправка денег назад
                if (isset($status['LastCreatedOnTheBasisNumber']) && $status['LastCreatedOnTheBasisNumber']) {
                    if (strpos($status['LastCreatedOnTheBasisNumber'], '-') !== false) {
                        $statuses[$key]['NewMoneyTTN'] = $status['LastCreatedOnTheBasisNumber'];
                    } else {
                        $statuses[$key]['NewTTN'] = $status['LastCreatedOnTheBasisNumber'];
                    }
                }
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
     * Очистка ТТН: остаются только цифры.
     *
     * @internal Внутренняя функция для простоты обработки
     *
     * @param  string  $ttn  Номер ТТН
     * @return string
     */
    public function clearNumber(string $ttn): string
    {
        return preg_replace('/[^0-9]/', '', $ttn);
    }
}
