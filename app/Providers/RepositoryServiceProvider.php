<?php

namespace App\Providers;

use App\Interfaces\RemindersRepositoryInterface;
use App\Repositories\RemindersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RemindersRepositoryInterface::class, function ($app) {
            return $app->make(RemindersRepository::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
