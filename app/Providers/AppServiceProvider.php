<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('photo_count', function ($attribute, $value, $parameters, $validator) {
            $min = Arr::get($parameters, 0);
            $max = Arr::get($parameters, 1);

            $count = count($value);

            return $count >= $min && $count <= $max;
        });

        Validator::replacer('photo_count', function ($message, $attribute, $rule, $parameters) {
            $min = Arr::get($parameters, 0);
            $max = Arr::get($parameters, 1);

            return str_replace([':min', ':max'], [$min, $max], $message);
        });
    }
}
