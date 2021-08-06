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
