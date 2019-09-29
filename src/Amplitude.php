<?php

namespace LaravelAmplitude;

use LaravelAmplitude\Drivers\AmplitudeDriverInterface;

class Amplitude
{
    /** @var AmplitudeDriverInterface */
    private $driver;

    /**
     * Amplitude constructor.
     *
     * @param AmplitudeDriverInterface $driver
     */
    public function __construct(AmplitudeDriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function init($apiKey)
    {
        $this->driver->init($apiKey);
    }

    public function setUserId($userId)
    {
        $this->driver->setUserId($userId);
    }

    public function setUserProperties($userProperties)
    {
        $this->driver->setUserProperties($userProperties);
    }

    public function sendEvent($name, $properties = [])
    {
        $this->driver->sendEvent($name, $properties);
    }

    public function queueEvent($name, $properties = [])
    {
        $this->driver->queueEvent($name, $properties);
    }

    public function sendQueuedEvents()
    {
        $this->driver->sendQueuedEvents();
    }
}
