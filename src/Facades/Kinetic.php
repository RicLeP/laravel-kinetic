<?php

namespace Riclep\KineticApi\Facades;

use Illuminate\Support\Facades\Facade;

class Kinetic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kinetic';
    }
}
