<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Faculty\FacultyRepositoryInterface::class,
            \App\Repositories\Faculty\FacultyRepository::class,
        );
        $this->app->bind(
            \App\Repositories\Student\StudentRepositoryInterface::class,
            \App\Repositories\Student\StudentRepository::class
        );
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
