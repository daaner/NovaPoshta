<?php

namespace Daaner\NovaPoshta\Traits;

trait DocumentList
{
    /**
     * Отобразить полный список.
     *
     * @return void
     */
    public function showFullList(): void
    {
        $this->methodProperties['GetFullList'] = 1;
    }

    /**
     * Фильтр присутствия обратной доставки.
     *
     * @return void
     */
    public function showRedeliveryMoney(): void
    {
        $this->methodProperties['RedeliveryMoney'] = 1;
    }

    /**
     * Фильтр полного списка всех актуальных ЭН (по которым не написано заявление на возврат или утилизацию) не забранных получателями посылок.
     *
     * @return void
     */
    public function showUnassembledCargo(): void
    {
        $this->methodProperties['UnassembledCargo'] = 1;
    }
}
