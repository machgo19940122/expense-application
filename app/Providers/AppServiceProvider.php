<?php

namespace App\Providers;
use App\Models\expense;
use DB;
use Illuminate\Support\ServiceProvider;
//全ての画面に変数$count_approvalを渡すため
use Illuminate\Support\Facades\View; 
//herokuのmigration
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
        //全てのviewに$count_approval_expense変数渡す
        View::composer('*', function($view) {
            $get_approval_expense=expense::wherestatus(0)->where('expense', '>=', 1000)->get();
            $count_approval=count($get_approval_expense);
            $view->with('count_approval',(int)$count_approval);
          });

          //heroku
          if(\App::environment(['production'])){
            \URL::forceScheme('https');
          }

          Schema::defaultStringLength(191);

    }
}
