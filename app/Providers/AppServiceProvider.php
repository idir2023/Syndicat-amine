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
        $parameters = Parameter::first();

        // Guard if there are no parameters
        if ($parameters) {
            // Share the parameters with all views if found
            View::share('appParameters', $parameters);
        } else {
            // Optionally, you can share default values if no parameters exist
            View::share('appParameters', (object)[
                'logo' => 'default-logo.png', // Default logo path
                'app_name' => 'Default App Name' // Default app name
            ]);
        }

    }
}
