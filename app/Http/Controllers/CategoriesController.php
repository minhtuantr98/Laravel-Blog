<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Post ;
use App\Category;
use Carbon\Carbon;
use App\CategoryTranslation;;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show($locale, $slug)
    {
        $category = DB::table('categories')
                        ->join('category_translations', 'categories.id' , '=', 'category_translations.category_id')
                        ->where('categories.slug' , $slug)->where('category_translations.locale' , $locale)
                        ->select('category_translations.name', 'category_translations.category_id' , 'category_translations.locale')
                        ->first();
                                
        $posts = DB::table('posts')
                    ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                    ->where('published_at', '<', Carbon::now())
                    ->where('posts.category_id', $category->category_id)
                    ->where('active', 1)
                    ->select('posts.slug', 'posts.category_id', 'posts.active', 'posts.user_id' ,'posts.published_at', 'post_translations.title', 'post_translations.content' ,'post_translations.id', 'post_translations.locale')
                    ->where('locale' , $locale)->orderBy('id', 'desc')->paginate(5);

        view()->share('menu', Controller::changeMenu($locale));

        return view('categories.show', compact('posts', 'category'));
    }
}
