<?php

namespace Novarift\Actor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Novarift\Actor\Actor
 */
class Actor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Novarift\Actor\Actor::class;
    }
}
