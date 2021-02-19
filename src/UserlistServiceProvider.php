<?php

namespace Userlist\Laravel;

use Illuminate\Support\ServiceProvider;

class UserlistServiceProvider extends ServiceProvider
{
    public $bindings = [
        Contracts\UserTransform::class => Services\UserTransform::class,
        Contracts\CompanyTransform::class => Services\CompanyTransform::class,
        Contracts\EventTransform::class => Services\EventTransform::class,
        Contracts\Push::class => Services\DirectPush::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/userlist.php';

        $this->publishes([$configPath => config_path('userlist.php')], 'config');
        $this->mergeConfigFrom($configPath, 'userlist');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\ImportCommand::class,
                Console\Commands\ImportUsersCommand::class,
                Console\Commands\ImportCompaniesCommand::class
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Userlist\Push::class, function($app) {
            return new \Userlist\Push(config('userlist'));
        });
    }
}
