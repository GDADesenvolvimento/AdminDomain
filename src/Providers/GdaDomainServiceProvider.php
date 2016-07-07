<?php
namespace GdaDesenv\AdminClient\Providers;

use Illuminate\Support\ServiceProvider;

class GdaDomainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes.php';
        }
        $this->loadViewsFrom(__DIR__ . "/../../resources/views","AdminDomain");
        $this->publishes([
            __DIR__."/../../database/migrations" => database_path("migrations")
        ],"migrations");
        $this->publishes([
            __DIR__."/../../tests" => base_path('tests')
        ],"tests");
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}