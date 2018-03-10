<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\WorkarBasicInfo;
use App\Depertment;
use App\PaymentSystem;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view::composer('backEnd.*', function($view){
            $admin_roles = Null;
            if( Auth::User()){
                $admin_role = Auth::User()->roles()->get();
                $pivote_date = $admin_role->pluck('pivot');
                $admin_roles = $pivote_date->pluck('role_id')->toArray();
            }
            
            $view->with('admin_roles', $admin_roles);
                
        });

        view::composer('backEnd.includes.pageHeaderContent', function($view){
            $totalWorker=WorkarBasicInfo::count();
            $totalDept =Depertment::count();
            $totalPaymentTypes = PaymentSystem::where('status',1)->count();

            $view->with('totalWorker', $totalWorker)
                ->with('totalDept', $totalDept)
                ->with('totalPaymentTypes', $totalPaymentTypes);
        });

        view::composer('backEnd.salary.salarys', function($view){
            $paymentTypes = PaymentSystem::where('status',1)->take(5)->get();
            $view->with('paymentTypes', $paymentTypes);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
