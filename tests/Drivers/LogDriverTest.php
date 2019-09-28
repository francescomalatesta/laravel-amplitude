<?php

namespace LaravelAmplitude\Tests\Drivers;


use Illuminate\Log\LogManager;
use LaravelAmplitude\Drivers\LogDriver;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LogDriverTest extends TestCase
{
    /** @var LogManager | MockObject */
    private $logger;

    private $driver;

    public function setUp()
    {
        $this->logger = $this->getMockBuilder(LogManager::class)->disableOriginalConstructor()->getMock();
        $this->driver = new LogDriver($this->logger);
    }

    /**
     * @test
     */
    public function it_should_log_init()
    {
        $this->logger->expects(self::once())
            ->method('info')
            ->with('Laravel Amplitude - Initialized with API Key: APIKEY');

        $this->driver->init('APIKEY');
    }

    /**
     * @test
     */
    public function it_should_log_user_id_set()
    {
        $this->logger->expects(self::once())
            ->method('info')
            ->with('Laravel Amplitude - Set User ID: ID');

        $this->driver->setUserId('ID');
    }

    /**
     * @test
     */
    public function it_should_log_user_properties_set()
    {
        $this->logger->expects(self::once())
            ->method('info')
            ->with('Laravel Amplitude - Set User Properties: {"param":"value"}');

        $this->driver->setUserProperties(['param' => 'value']);
    }

    /**
     * @test
     */
    public function it_should_log_event_sending()
    {
        $this->logger->expects(self::once())
            ->method('info')
            ->with('Laravel Amplitude - Event Sent - MYEVENT - Properties: {"param":"value","param2":[1,2,3],"param3":{"x":1,"y":2}}');

        $this->driver->sendEvent('MYEVENT', ['param' => 'value', 'param2' => [1, 2, 3], 'param3' => ['x' => 1, 'y' => 2]]);
    }
}
