<?php

namespace App\Providers;

use DB;
use Session;
use App\Category;
use App\CategoryTranslation;
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
        if(!Session:: has('locale')){
            Session::put('locale', 'en');
        } 
        
        $menu = DB::table('categories')
        ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
        ->select('categories.slug', 'category_translations.name')
        ->where('category_translations.locale',Session::get('locale'))->get();

        view()->share('menu', $menu);
    }
}
