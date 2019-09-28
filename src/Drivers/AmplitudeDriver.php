<?php


namespace LaravelAmplitude\Drivers;


use Zumba\Amplitude\Amplitude;

class AmplitudeDriver implements AmplitudeDriverInterface
{
    /** @var Amplitude */
    private $instance;

    /**
     * @param Amplitude $instance
     */
    public function __construct(Amplitude $instance)
    {
        $this->instance = $instance;
    }

    public function init($apiKey)
    {
        $this->instance->init($apiKey);
    }

    public function setUserId($userId)
    {
        $this->instance->setUserId($userId);
    }

    public function setUserProperties($userProperties)
    {
        $this->instance->setUserProperties($userProperties);
    }

    public function sendEvent($name, $properties)
    {
        $this->instance->logEvent(
            $name,
            $properties
        );
    }

    public function getDriverName()
    {
        return 'amplitude';
    }
}
