<?php

namespace App\Providers;

use App\Services\Customer\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = app(CartService::class)->getCart();
            $totalCount = collect($cart)->count($cart);
            $view->with('cartItemCount', $totalCount);
        });
    }

}
