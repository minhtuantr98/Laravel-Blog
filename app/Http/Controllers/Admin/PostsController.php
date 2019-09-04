<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Post ;
use App\Category;
use App\PostTranslation;
use Illuminate\Support\Str;
use App\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{   
    public function index()
    {
        return view('admin.posts.index');
    }

    public function listing(Request $request)
    {    
        $posts = DB::table('posts')
                    ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                    ->where('post_translations.locale', 'en')
                    ->select('posts.slug', 'post_translations.post_id', 'post_translations.title', 'post_translations.id', 'post_translations.locale')
                    ->orderBy('id', 'desc')->paginate(5);

        return $posts;
    }

    public function edit($id)
    {
        $post = Post::find($id);

        $posts = Post::find($id)->postTranslations()->get();

        $categories = DB::table('categories')
                        ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
                        ->where('category_translations.locale', 'en')
                        ->select('categories.id', 'category_translations.name')
                        ->get();

        return view('admin.posts.edit', compact('categories' ,'posts', 'post'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'title_en' => 'required|unique:post_translations,title',
        //     'title_jp' => 'required|unique:post_translations,title',
        //     'content_en' => 'required|unique:post_translations,content',
        //     'content_jp' => 'required|unique:post_translations,content',
        // ]);

        Post::findOrFail($id)
            ->fill([
                'slug' => Str::slug($request->title_en),
                'category_id' => $request->category,
                'active' => $request->input('active', 0),
                'published_at' => $request->published,
            ])
            ->save();

        PostTranslation::where('post_id', $id)->where('locale', 'en')->first()
            ->fill([
                'title' => $request->title_en,
                'content' => $request->content_en,
            ])
            ->save();

        PostTranslation::where('post_id', $id)->where('locale', 'jp')->first()
            ->fill([
                'title' => $request->title_jp,
                'content' => $request->content_jp,
            ])
            ->save();

        return (['message' => 'Success']);
    }

    public function create()
    {
        $categories = CategoryTranslation::where('locale', 'en')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {        
        $this->validate($request, [
            'title_en' => 'required|unique:post_translations,title',
            'title_jp' => 'required|unique:post_translations,title',
        ]);

        Post::forceCreate([
            'slug' => Str::slug($request->title_en),
            'category_id' => $request->category,
            'active' => $request->input('active', 0),
            'user_id' => Auth::user()->id,
            'published_at' => $request->published,
        ]);

        PostTranslation::forceCreate([
            'title' => $request->title_en,
            'content' => $request->content_en,
            'post_id' => Post::orderBy('id', 'desc')->first()->id,
            'locale' => 'en'
        ]);

        PostTranslation::forceCreate([
            'title' => $request->title_jp,
            'content' => $request->content_jp,
            'post_id' => Post::orderBy('id', 'desc')->first()->id,
            'locale' => 'jp'
        ]);

        return (['message' => 'Success']);
    }

    public function destroy($id,REQUEST $request)
    {
        Post::findOrFail($id)->delete();

        return Post::where('title', 'like', $request->search .''. '%')
                    ->where('active', 'like', '%' .$request->active. '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
    }

}
