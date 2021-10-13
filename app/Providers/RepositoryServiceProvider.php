<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Eloquent\{UserRepo, ClientRepo};
use App\Repositories\Interfaces\{IUserRepo, IClientRepo};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepo::class, UserRepo::class);
        $this->app->bind(IClientRepo::class, ClientRepo::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
