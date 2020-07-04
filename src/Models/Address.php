<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;

class Address extends NovaPoshta
{

  use Limit;

  protected $model = 'Address';
  protected $calledMethod;
  protected $methodProperties;


  public function getAreas() {
    $this->calledMethod = 'getAreas';
    $this->methodProperties = null;

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function getCities($find = null, $string = true) {
    $this->calledMethod = 'getCities';
    $this->methodProperties = array();
    $this->addLimit();
    $this->getPage();

    if ($find) {
      if ($string) {
        $this->methodProperties['FindByString'] = $find;
      } else {
        $this->methodProperties['Ref'] = $find;
      }
    }

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function getWarehouses($cityRef, $string = true) {
    $this->calledMethod = 'getWarehouses';
    $this->methodProperties = array();

    if ($string) {
      $this->methodProperties['CityName'] = $cityRef;
    } else {
      $this->methodProperties['CityRef'] = $cityRef;
    }

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function getWarehouseTypes($cityRef, $string = true) {
    $this->calledMethod = 'getWarehouseTypes';
    $this->methodProperties = array();

    if ($string) {
      $this->methodProperties['CityName'] = $cityRef;
    } else {
      $this->methodProperties['CityRef'] = $cityRef;
    }

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function getWarehouseSettlements($settlementRef) {
    $this->calledMethod = 'getWarehouses';
    $this->methodProperties = array();
    $this->methodProperties['SettlementRef'] = $settlementRef;

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function searchSettlements($search) {
    $this->calledMethod = 'searchSettlements';
    $this->methodProperties = array();
    $this->addLimit();
    $this->methodProperties['CityName'] = $search;

    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }


  public function searchSettlementStreets($ref, $street = null) {
    $this->calledMethod = 'searchSettlementStreets';
    $this->methodProperties = array();
    $this->addLimit();

    $this->methodProperties['SettlementRef'] = $ref;
    $this->methodProperties['StreetName'] = $street;

    dump($this->methodProperties);
    return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
  }

}
