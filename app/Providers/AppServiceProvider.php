<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Categorie;
use App\Observers\BookObserver;
use App\Policies\BookPolicy;
use App\Policies\CategoriePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

            Book::observe(BookObserver::class);

        Gate::before(function ($user, $ability) {

            if($user->hasRole('admin')){

             return  true;

              }


return null;
        });

        Gate::policy(Book::class, BookPolicy::class);
            Gate::policy(Categorie::class, CategoriePolicy::class);

    }
}
