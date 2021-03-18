<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;

class Orders extends NovaPoshta
{
    protected $model = 'orders';
    protected $calledMethod;
    protected $methodProperties = null;

	/**
	 * printDocument method of InternetDocument model.
	 *
	 * @param array|string $DocumentRefs Array of Documents IDs
	 * @param string       $type         (pdf|html)
	 *
	 * @return mixed
	 */
	public function printDocument($DocumentRefs, $type = 'html')
	{
		if (is_array($DocumentRefs) === false) {
			$DocumentRefs = explode(', ', /** @scrutinizer ignore-type */ $DocumentRefs);
		}

		$orders = "orders[]/" . implode("/orders[]/", $DocumentRefs);
		$this->calledMethod = 'printDocument/' . $orders . '/type/' . $type . '/apiKey/' . $this->getApi();

		return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
	}
}
