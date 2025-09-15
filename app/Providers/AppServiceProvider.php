<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Collection::macro('price', function($campo){
            return $this->map(function ($elemento) use ($campo){
             $elemento[$campo] = number_format($elemento[$campo],2,',','.');
             $elemento[$campo] .=  '&nbsp;&#8364;';
             return $elemento;   
            });
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
