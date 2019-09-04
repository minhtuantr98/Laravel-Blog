<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($locale, $slug)
    {
        $post = DB::table('posts')
                ->join('post_translations', 'posts.id' , '=', 'post_translations.post_id')
                ->where('posts.slug', $slug)
                ->where('post_translations.locale', Session::get('locale'))
                ->select('post_translations.title', 'post_translations.content')
                ->first();

        view()->share('menu', Controller::changeMenu(Session::get('locale')));

        return view('posts.show', compact('post'));
    }
}
