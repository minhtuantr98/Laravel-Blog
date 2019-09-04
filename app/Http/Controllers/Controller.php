<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function changeMenu($locale)
    {
        return DB::table('categories')
                    ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
                    ->select('categories.slug', 'category_translations.name', 'category_translations.locale')
                    ->where('category_translations.locale',$locale)->get();
    }
}
