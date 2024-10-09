<?php

namespace App\Providers;

use App\Models\Parameter;
use App\Models\Residence;
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
        //
        // $residences = Residence::all();
        // View::share('residences', $residences);

        // Retrieve the parameters from the database (you can limit to one or handle multiple rows)
        $parameters = Parameter::first(); // Assuming you have one row or want the first one

        // Share the parameters with all views
        View::share('appParameters', $parameters);
    }
}
