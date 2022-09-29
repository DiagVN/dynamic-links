<?php

namespace DiagVN\DynamicLink;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;

class DynamicLinkServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                //file source => file destination below
                __DIR__ . '/config/dynamic_link.php' => config_path('dynamic_link.php'),
                //you can also add more configs here
            ]
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function() {
            return new Client(new GuzzleClient([
                'timeout' => config('dynamic_link.timeout'),
            ]));
        });
    }
}
