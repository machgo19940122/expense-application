<?php

namespace App\Providers;
use App\Models\Expense;
use DB;
use Illuminate\Support\ServiceProvider;
//全ての画面に変数$count_approvalを渡すため
use Illuminate\Support\Facades\View; 

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
            $get_approval_expense=Expense::wherestatus(0)->where('expense', '>=', 1000)->get();
            $count_approval=count($get_approval_expense);
            $view->with('count_approval',(int)$count_approval);
          });

          //heroku
          if(\App::environment(['production'])){
            \URL::forceScheme('https');
          }

    }
}
