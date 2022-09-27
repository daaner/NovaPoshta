<?php

namespace Daaner\NovaPoshta\Traits;

trait DocumentList
{
    /**
     * @return void
     */
    public function showFullList(): void
    {
        $this->methodProperties['GetFullList'] = 1;
    }

    /**
     * @return void
     */
    public function showRedeliveryMoney(): void
    {
        $this->methodProperties['RedeliveryMoney'] = 1;
    }

    /**
     * @return void
     */
    public function showUnassembledCargo(): void
    {
        $this->methodProperties['UnassembledCargo'] = 1;
    }
}
