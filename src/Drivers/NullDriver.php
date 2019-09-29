<?php


namespace LaravelAmplitude\Drivers;


class NullDriver implements AmplitudeDriverInterface
{
    public function init($apiKey)
    {
        return;
    }

    public function setUserId($userId)
    {
        return;
    }

    public function setUserProperties($userProperties)
    {
        return;
    }

    public function sendEvent($name, $properties)
    {
        return;
    }

    public function queueEvent($name, $properties)
    {
        return;
    }

    public function sendQueuedEvents()
    {
        return;
    }

    public function getDriverName()
    {
        return 'null';
    }
}
