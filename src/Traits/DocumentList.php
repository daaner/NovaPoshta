<?php

namespace Daaner\NovaPoshta\Traits;

trait DocumentList
{
    /**
     * Отобразить полный список.
     *
     * @return $this
     */
    public function showFullList(): self
    {
        $this->methodProperties['GetFullList'] = 1;

        return $this;
    }

    /**
     * Фильтр присутствия обратной доставки.
     *
     * @return $this
     */
    public function showRedeliveryMoney(): self
    {
        $this->methodProperties['RedeliveryMoney'] = 1;

        return $this;
    }

    /**
     * Фильтр полного списка всех актуальных ЭН (по которым не написано заявление на возврат или утилизацию) не забранных получателями посылок.
     *
     * @return $this
     */
    public function showUnassembledCargo(): self
    {
        $this->methodProperties['UnassembledCargo'] = 1;

        return $this;
    }
}
