<?php

namespace LaravelAuto\Sso;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use LaravelAuto\Sso\Commands;
use LaravelAuto\Sso\Controllers\ServerController;

class SingleSignOnServiceProvider extends ServiceProvider
{
    /**
     * Configuration file name.
     *
     * @var string
     */
    protected string $configFileName = 'laravel-sso.php';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishConfig(__DIR__ . '/../config/' . $this->configFileName);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\CreateBroker::class,
                Commands\DeleteBroker::class,
                Commands\ListBrokers::class,
            ]);
        }

        $this->loadRoutes();
    }

    /**
     * Register services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make(ServerController::class);
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function getConfigPath(): string
    {
        return config_path($this->configFileName);
    }

    /**
     * Publish the config file
     *
     * @param string $configPath
     */
    protected function publishConfig(string $configPath): void
    {
        $this->publishes([$configPath => $this->getConfigPath()]);
    }

    /**
     * Load necessary routes.
     *
     * @return void
     */
    protected function loadRoutes(): void
    {
        // If this page is server, load routes which is required for the server.
        if (config('laravel-sso.type') == 'server') {
            $this->loadRoutesFrom(__DIR__.'/Routes/server.php');
        }
    }
}
