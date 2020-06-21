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
    * @param array $documents
    * @return array
    */
  public function getStatusDocuments($documents) {
    $this->calledMethod = 'getStatusDocuments';

    $methodProperties = [
      'Documents' => $documents
    ];

    return $this->getResponse($this->model, $this->calledMethod, $methodProperties);
  }

  /**
    * Проверка еденичной ТТН или массива. Телефон, если указан, подставляется один для всех
    *
    * Номер ТТН либо массив ТТНок
    * @param string|array $ttn
    * Номер телефона получателя или отправителя
    * @param string|null $phone
    * @return array
    */
  public function checkTTN($ttns, $phone = null) {
    $documents = array();

    if (is_array($ttns)) {
      foreach ($ttns as $key => $ttn) {
        array_push($documents, ['DocumentNumber' => $ttn, 'Phone' => $phone]);
      }
    } else {
      array_push($documents, ['DocumentNumber' => $ttns, 'Phone' => $phone]);
    }

    return $this->getStatusDocuments($documents);
  }

  /**
    * Получение статусов одной ТТН или массива
    *
    * @param string|array $ttn
    * @return array
    */
  public function getStatusTTN($ttns) {
    $answer = $this->checkTTN($ttns);
    $statuses = array();

    if ($answer['success'] && !empty($answer['result'])) {
      foreach ($answer['result'] as $key => $status) {
        array_push($statuses, [
          'Number' => $status['Number'],
          'StatusCode' => $status['StatusCode'],
          'Status' => $status['Status'],
          'StatusLocale' => trans('novaposhta::novaposhta.statusCode.' . $status['StatusCode']),
          'NewTTN' => isset($status['LastCreatedOnTheBasisNumber']) && $status['LastCreatedOnTheBasisNumber'] ? $status['LastCreatedOnTheBasisNumber'] : null,
        ]);
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
