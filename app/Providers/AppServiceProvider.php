<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
            \App\Repositories\Faculties\FacultyRepositoryInterface::class,
            \App\Repositories\Faculties\FacultyRepository::class,
        );
        $this->app->bind(
            \App\Repositories\Students\StudentRepositoryInterface::class,
            \App\Repositories\Students\StudentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Subjects\SubjectRepositoryInterface::class,
            \App\Repositories\Subjects\SubjectRepository::class
        );
        $this->app->bind(
            \App\Repositories\Users\UserRepositoryInterface::class,
            \App\Repositories\Users\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Student_subject\Student_subjectRepositoryInterface::class,
            \App\Repositories\Student_subject\Student_subjectRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
