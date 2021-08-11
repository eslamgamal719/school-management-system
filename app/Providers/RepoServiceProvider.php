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

        $this->app->bind(
            'App\Repositories\ReceiptStudentRepositoryInterface',
            'App\Repositories\ReceiptStudentRepository',
        );

        $this->app->bind(
            'App\Repositories\ProcessingFeeRepositoryInterface',
            'App\Repositories\ProcessingFeeRepository',
        );

        $this->app->bind(
            'App\Repositories\PaymentRepositoryInterface',
            'App\Repositories\PaymentRepository',
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
