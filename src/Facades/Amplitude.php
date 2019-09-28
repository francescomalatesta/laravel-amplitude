<?php

namespace LaravelAmplitude\Facades;

use Illuminate\Support\Facades\Facade;

class Amplitude extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \LaravelAmplitude\Amplitude::class;
    }
}
