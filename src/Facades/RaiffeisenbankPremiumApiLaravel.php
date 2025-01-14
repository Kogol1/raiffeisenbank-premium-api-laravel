<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kogol1\RaiffeisenbankPremiumApiLaravel\RaiffeisenbankPremiumApiLaravel
 */
class RaiffeisenbankPremiumApiLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kogol1\RaiffeisenbankPremiumApiLaravel\RaiffeisenbankPremiumApiLaravel::class;
    }
}
