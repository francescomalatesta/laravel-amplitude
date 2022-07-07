<?php

namespace LaravelAmplitude\Providers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\ServiceProvider;
use LaravelAmplitude\Amplitude;
use LaravelAmplitude\AmplitudeFactory;
use LaravelAmplitude\Drivers\AmplitudeDriver;
use LaravelAmplitude\Drivers\LogDriver;
use LaravelAmplitude\Drivers\NullDriver;
use LaravelAmplitude\Events\SendQueuedEvents;

class LaravelAmplitudeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/amplitude.php' => config_path('amplitude.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Amplitude::class, function () {
            $amplitudeDriver = new AmplitudeDriver(\Zumba\Amplitude\Amplitude::getInstance());
            $amplitudeDriver->init(config('amplitude.api_key'));

            $factory = new AmplitudeFactory([
                $amplitudeDriver,
                $this->app->make(LogDriver::class),
                $this->app->make(NullDriver::class)
            ]);

            return $factory->makeFor(config('amplitude.driver', 'amplitude'));
        });

        /** @var Dispatcher $eventDispatcher */
        $eventDispatcher = app()->make(Dispatcher::class);
        $eventDispatcher->listen(SendQueuedEvents::class, function() {
            /** @var Amplitude $amplitude */
            $amplitude = app()->make(Amplitude::class);
            $amplitude->sendQueuedEvents();
        });

        $eventDispatcher->listen([RequestHandled::class, CommandFinished::class], function() {
            event(new SendQueuedEvents());
        });
    }
}
