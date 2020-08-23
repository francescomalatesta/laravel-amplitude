<?php


namespace LaravelAmplitude\Tests;


use LaravelAmplitude\Amplitude;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use LaravelAmplitude\Drivers\AmplitudeDriverInterface;

class AmplitudeTest extends TestCase
{
    /** @var MockObject | AmplitudeDriverInterface */
    private $driver;

    /** @var Amplitude */
    private $amplitude;

    public function setUp() : void
    {
        $this->driver = $this->getMockBuilder(AmplitudeDriverInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->amplitude = new Amplitude($this->driver);
    }

    /**
     * @test
     */
    public function it_should_init()
    {
        $this->driver->expects(self::once())
            ->method('init')
            ->with('APIKEY');

        $this->amplitude->init('APIKEY');
    }

    /**
     * @test
     */
    public function it_should_set_user_id()
    {
        $this->driver->expects(self::once())
            ->method('setUserId')
            ->with('ID');

        $this->amplitude->setUserId('ID');
    }

    /**
     * @test
     */
    public function it_should_set_user_properties()
    {
        $this->driver->expects(self::once())
            ->method('setUserProperties')
            ->with(['property' => 'value']);

        $this->amplitude->setUserProperties(['property' => 'value']);
    }

    /**
     * @test
     */
    public function it_should_send_event()
    {
        $this->driver->expects(self::once())
            ->method('sendEvent')
            ->with('name', ['prop' => '123']);

        $this->amplitude->sendEvent('name', ['prop' => '123']);
    }

    /**
     * @test
     */
    public function it_should_send_event_without_properties()
    {
        $this->driver->expects(self::once())
            ->method('sendEvent')
            ->with('name', []);

        $this->amplitude->sendEvent('name');
    }

    /**
     * @test
     */
    public function it_should_queue_event()
    {
        $this->driver->expects(self::once())
            ->method('queueEvent')
            ->with('name', []);

        $this->amplitude->queueEvent('name');
    }

    /**
     * @test
     */
    public function it_should_send_previously_queued_events()
    {
        $this->driver->expects(self::once())
            ->method('sendQueuedEvents');

        $this->amplitude->sendQueuedEvents();
    }
}
