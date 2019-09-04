<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\CategoryTranslation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ModelCouldNotDeletedException;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function listting() 
    {
        return CategoryTranslation::where('locale', 'en')->orderBy('id', 'desc')->paginate(3);
    }

    public function edit($id)   
    {
        $category = Category::find($id)->categoryTranslations()->get();

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:category_translations,name',
            'name_jp' => 'required|unique:category_translations,name'
        ]);

        Category::find($id)
            ->fill([
                'slug' => Str::slug($request->name_en),
            ])
            ->save();

        CategoryTranslation::where('category_id', $id)->where('locale', 'en')->first()
            ->fill([
                'name' => $request->name_en
            ])
            ->save();

        CategoryTranslation::where('category_id', $id)->where('locale', 'jp')->first()
            ->fill([
                'name' => $request->name_jp
            ])
            ->save();

        return (['message' => 'Success']);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:category_translations,name',
            'name_jp' => 'required|unique:category_translations,name'
        ]);
        
        Category::forceCreate([
            'slug' => Str::slug($request->name_en)
        ]);
        
        CategoryTranslation::forceCreate([
            'name' => $request->name_en,
            'category_id' => Category::orderBy('id', 'desc')->first()->id,
            'locale' => 'en'
        ]);

        CategoryTranslation::forceCreate([
            'name' => $request->name_jp,
            'category_id' => Category::orderBy('id', 'desc')->first()->id,
            'locale' => 'jp'
        ]);

        return (['message' => 'Success']);
    }
    
    public function destroy($id)
    {   
        try {
            Category::findOrFail($id)->delete();
        } catch (ModelCouldNotDeletedException $exception) {
            return ['error' => 'U can delete it'] ;
        }

        return Category::orderBy('id', 'desc')->paginate(3);
    }
}
