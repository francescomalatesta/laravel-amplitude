<?php


namespace LaravelAmplitude\Drivers;


interface AmplitudeDriverInterface
{
    public function init($apiKey);
    public function setUserId($userId);
    public function setUserProperties($userProperties);
    public function sendEvent($name, $properties);

    public function getDriverName();
}
