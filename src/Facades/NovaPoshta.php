<?php

namespace Daaner\NovaPoshta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Daaner\NovaPoshta
 */
class NovaPoshta extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'novaposhta';
    }
}
