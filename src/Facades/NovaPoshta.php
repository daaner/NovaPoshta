<?php

namespace Daaner\NovaPoshta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see https://github.com/daaner/novaposhta
 */
class NovaPoshta extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'novaposhta';
    }
}
