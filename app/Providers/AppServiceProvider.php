<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Admin\Tour\TourRepositoryInterface::class,
            \App\Repositories\Admin\Tour\TourRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Admin\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Admin\Category\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\BookTour\BookTourRepositoryInterface::class,
            \App\Repositories\User\BookTour\BookTourRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\Comment\CommentRepositoryInterface::class,
            \App\Repositories\User\Comment\CommentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\Review\ReviewRepositoryInterface::class,
            \App\Repositories\User\Review\ReviewRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\Payment\PaymentRepositoryInterface::class,
            \App\Repositories\User\Payment\PaymentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Admin\Payment\PaymentRepositoryInterface::class,
            \App\Repositories\Admin\Payment\PaymentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\Social\SocialRepositoryInterface::class,
            \App\Repositories\User\Social\SocialRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\Tour\TourRepositoryInterface::class,
            \App\Repositories\User\Tour\TourRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\User\UserRepositoryInterface::class,
            \App\Repositories\User\USer\UserRepository::class
        );
    }
}
