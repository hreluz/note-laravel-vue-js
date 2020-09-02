<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

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
        //https://www.oreilly.com/library/view/full-stack-vuejs-2/9781788299589/30f2198e-5e56-4a32-a72a-97cea5030641.xhtml 
        Schema::defaultStringLength(191);
    }
}
