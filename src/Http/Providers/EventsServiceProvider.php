<?php

namespace League\Skeleton\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Class EventsServiceProvider.
 */
class EventsServiceProvider extends ServiceProvider
{

    public function register()
    {
//        dump('Registering Events package');
        if (!defined('EVENTS_PATH')) {
            define('EVENTS_PATH', realpath(__DIR__.'/../../'));
        }

        $this->registerEloquentFactoriesFrom(EVENTS_PATH . '/database/factories');

    }

    public function boot()
    {
        $this->defineRoutes();
        $this->loadViews();
        $this->loadmigrations();

    }

    private function defineRoutes()
    {
        require EVENTS_PATH . '/routes/web.php';
    }

    private function loadViews()
    {
        $this->loadViewsFrom(EVENTS_PATH.'/resources/views', 'events');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(EVENTS_PATH.'/database/migrations');
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}