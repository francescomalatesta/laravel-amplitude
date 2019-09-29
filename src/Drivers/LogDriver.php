<?php


namespace LaravelAmplitude\Drivers;


use Illuminate\Log\LogManager;

class LogDriver implements AmplitudeDriverInterface
{
    /** @var LogManager */
    private $logger;

    /**
     * @param LogManager $logger
     */
    public function __construct(LogManager $logger)
    {
        $this->logger = $logger;
    }

    public function init($apiKey)
    {
        $this->logger->info('Laravel Amplitude - Initialized with API Key: ' . $apiKey);
    }

    public function setUserId($userId)
    {
        $this->logger->info('Laravel Amplitude - Set User ID: ' . $userId);
    }

    public function setUserProperties($userProperties)
    {
        $this->logger->info('Laravel Amplitude - Set User Properties: ' . json_encode($userProperties));
    }

    public function sendEvent($name, $properties)
    {
        $this->logger->info(sprintf(
            'Laravel Amplitude - Event Sent - %s - Properties: %s',
            $name,
            json_encode($properties)
        ));
    }

    public function queueEvent($name, $properties)
    {
        $this->logger->info(sprintf(
            'Laravel Amplitude - Event Queued - %s - Properties: %s',
            $name,
            json_encode($properties)
        ));
    }

    public function sendQueuedEvents()
    {
        $this->logger->info('Laravel Amplitude - Sent all previously queued events');
    }

    public function getDriverName()
    {
        return 'log';
    }
}
