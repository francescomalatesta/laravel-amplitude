<?php


namespace LaravelAmplitude\Tests\Drivers;


use Zumba\Amplitude\Amplitude;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use LaravelAmplitude\Drivers\AmplitudeDriver;

class AmplitudeDriverTest extends TestCase
{
    /** @var Amplitude | MockObject */
    private $amplitude;

    /** @var AmplitudeDriver */
    private $driver;

    public function setUp() : void
    {
        $this->amplitude = $this->getMockBuilder(Amplitude::class)->disableOriginalConstructor()->getMock();
        $this->driver = new AmplitudeDriver($this->amplitude);
    }

    /**
     * @test
     */
    public function it_should_init()
    {
        $this->amplitude->expects(self::once())
            ->method('init')
            ->with('APIKEY');

        $this->driver->init('APIKEY');
    }

    /**
     * @test
     */
    public function it_should_set_user_id()
    {
        $this->amplitude->expects(self::once())
            ->method('setUserId')
            ->with('ID');

        $this->driver->setUserId('ID');
    }

    /**
     * @test
     */
    public function it_should_set_user_properties()
    {
        $this->amplitude->expects(self::once())
            ->method('setUserProperties')
            ->with(['param' => 'value']);

        $this->driver->setUserProperties(['param' => 'value']);
    }

    /**
     * @test
     */
    public function it_should_send_event()
    {
        $this->amplitude->expects(self::once())
            ->method('logEvent')
            ->with('MYEVENT', ['param' => 'value', 'param2' => [1, 2, 3], 'param3' => ['x' => 1, 'y' => 2]]);

        $this->driver->sendEvent('MYEVENT', ['param' => 'value', 'param2' => [1, 2, 3], 'param3' => ['x' => 1, 'y' => 2]]);
    }

    /**
     * @test
     */
    public function it_should_queue_event()
    {
        $this->amplitude->expects(self::once())
            ->method('queueEvent')
            ->with('MYEVENT', []);

        $this->driver->queueEvent('MYEVENT', []);
    }

    /**
     * @test
     */
    public function it_should_send_queued_events()
    {
        $this->amplitude->expects(self::once())
            ->method('logQueuedEvents');

        $this->driver->sendQueuedEvents();
    }
}
