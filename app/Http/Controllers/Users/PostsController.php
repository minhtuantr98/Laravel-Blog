<?php

namespace App\Http\Controllers\Users;

use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Exceptions\ModelCouldNotDeletedException;

class PostsController extends Controller
{
    public function index()
    {   
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);

        return view('users.posts.index', compact('posts'));
    }

    public function edit($slug)
    {
        if (Post::where('slug', $slug)->firstOrFail()->user_id != Auth::user()->id) {
            return redirect()->back()->withError('U cant edit this , Not in your permission');
        }
        
        $post = Post::where('slug', $slug)->firstOrFail();

        $categories = Category::all();

        return view('users.posts.edit', compact('categories' ,'post'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        Post::where('slug', $slug)
            ->first()
            ->fill([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'category_id' => $request->category,
                'active' => 0,
                'user_id' => Auth::user()->id,
            ])
            ->save();
        
        return redirect('user/post');
    }

    public function create()
    {
        $categories = Category::all();

        return view('users.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {        
        $this->validate($request, [
            'title' => 'required|unique:posts,title',
            'content' => 'required'
        ]);

        Post::forceCreate([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category,
            'active' => 0,
            'user_id' => Auth::user()->id,
        ]);
    
        return redirect('user/post');
    }

    public function destroy($slug)
    {
        try {
            Post::where('slug', $slug)->firstOrFail()->delete();
        } catch (ModelCouldNotDeletedException $exception) {
            return redirect()->back()->withError('U cant delete it');
        }

        return redirect('user/post');
    }
}
