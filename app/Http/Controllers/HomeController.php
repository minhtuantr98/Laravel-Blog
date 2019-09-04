<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(REQUEST $request, $locale)
    {
        // if (!Session::has('locale')) {
        //     Session::put('locale', 'en');
        // }

        Session::put('locale', $locale);

        $posts = DB::table('posts')
                    ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                    ->where('published_at', '<', Carbon::now())
                    ->where('active', 1)
                    ->where('post_translations.title', 'like', '%' .$request->get('search'). '%')
                    ->select('posts.slug', 'posts.category_id', 'posts.active', 'posts.user_id' ,'posts.published_at', 'post_translations.title', 'post_translations.content' ,'post_translations.id', 'post_translations.locale')
                    ->where('locale' ,Session::get('locale'))->orderBy('id', 'desc')->paginate(5);

        view()->share('menu', Controller::changeMenu(Session::get('locale')));
        
        return view('home.index', compact('posts'));
    }
}
