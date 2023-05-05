<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
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
        view()->composer(['Admin.Dashboard.Main.navbar','Admin.Dashboard.Main.main','Customer.Main.main','Customer.Main.navbar'], function ($view) {
            $companyData = Company::first();
            $view->with('companyData', $companyData);
        });
    }
}
