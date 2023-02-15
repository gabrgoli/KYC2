<?php

namespace App\Providers;

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
        
        view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            if($view_name == "main") {
                $view_name = "";
            }
            if(strpos($view_name,'_') > 0) {
                $view_name = substr($view_name,strpos($view_name,'_')+1);
            }
            view()->share('view_name', $view_name);
        });
    }
}
