<?php

namespace App\Providers;

use App\Services\Customer\CartService;
use App\Services\JitTransactionService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('jit_transaction', function ($app) {
            return new JitTransactionService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });
        View::composer('*', function ($view) {
            if (! Request::is('admin/*')) {
                $cart = app(CartService::class)->getCart();
                $totalCount = collect($cart)->count($cart);
                $view->with('cartItemCount', $totalCount);
            }
        });
        Paginator::useBootstrap();
    }
}
