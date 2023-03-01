<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
            Schema::defaultStringLength(191);

            view()->composer('*', function($view){
            $view_name = str_replace('wizard', '', $view->getName());
            $view_name = str_replace('.', '', $view_name );
            if($view_name == "main") {
                $view_name = "";
            }
            if(strpos($view_name,'_') > 0) {
                $view_name = substr($view_name,strpos($view_name,'_')+1);
            }
            if($view_name == "step1") {
                $view_name = "Info";
            }
            if($view_name == "step2") {
                $view_name = "Payment";
            }
            if($view_name == "step3") {
                $view_name = "Verification";
            }
            if($view_name == "vPool") {
                $view_name = "vPOOL";
            }
            if($view_name == "vDelegator") {
                $view_name = "vDELEGATOR";
            }
            if($view_name == "vNft") {
                $view_name = "vNFT";
            }
            if($view_name == "vKyc") {
                $view_name = "vKYC";
            }
            if($view_name == "rKyb") {
                $view_name = "rKYB";
            }
            if($view_name == "rKyb") {
                $view_name = "rKYB";
            }
            view()->share('view_name', $view_name);
        });
    }
}
