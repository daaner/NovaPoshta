<?php

namespace Daaner\NovaPoshta\Traits;

trait DocumentList
{
    /**
     * @return this
     */
    public function showFullList()
    {
        $this->methodProperties['GetFullList'] = 1;

        return $this;
    }

    /**
     * @return this
     */
    public function showRedeliveryMoney()
    {
        $this->methodProperties['RedeliveryMoney'] = 1;

        return $this;
    }

    /**
     * @return this
     */
    public function showUnassembledCargo()
    {
        $this->methodProperties['UnassembledCargo'] = 1;

        return $this;
    }
}
