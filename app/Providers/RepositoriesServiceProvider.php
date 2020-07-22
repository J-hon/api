<?php

namespace App\Providers;

use App\Contracts\CartRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ReviewRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\SaveForLaterRepositoryInterface;

use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SaveForLaterRepository;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(SaveForLaterRepositoryInterface::class, SaveForLaterRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
    }
}
