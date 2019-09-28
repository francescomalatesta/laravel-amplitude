<?php


namespace LaravelAmplitude;

use LaravelAmplitude\Drivers\AmplitudeDriverInterface;

class AmplitudeFactory
{
    private $driversMap;

    public function __construct($driversMap)
    {
        /** @var AmplitudeDriverInterface $driver */
        foreach ($driversMap as $driver) {
            $this->driversMap[$driver->getDriverName()] = $driver;
        }
    }

    public function makeFor($driverName)
    {
        if (!in_array($driverName, array_keys($this->driversMap))) {
            throw new \Exception(sprintf('Driver "%s" not available', $driverName));
        }

        $driver = $this->driversMap[$driverName];
        return new Amplitude($driver);
    }
}
