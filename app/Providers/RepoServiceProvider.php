<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\TeacherRepositoryInterface',
            'App\Repositories\TeacherRepository',
        );

        $this->app->bind(
            'App\Repositories\StudentRepositoryInterface',
            'App\Repositories\StudentRepository',
        );

        $this->app->bind(
            'App\Repositories\PromotionRepositoryInterface',
            'App\Repositories\PromotionRepository',
        );

        $this->app->bind(
            'App\Repositories\GraduateRepositoryInterface',
            'App\Repositories\GraduateRepository',
        );

        $this->app->bind(
            'App\Repositories\FeesRepositoryInterface',
            'App\Repositories\FeesRepository',
        );

        $this->app->bind(
            'App\Repositories\FeesInvoicesRepositoryInterface',
            'App\Repositories\FeesInvoicesRepository',
        );
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
