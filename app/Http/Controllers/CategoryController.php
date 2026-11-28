<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-categories');
        $categories = Category::orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('manage-categories');
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('manage-categories');
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée.');
    }

    public function edit(Category $category)
    {
        Gate::authorize('manage-categories');
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('manage-categories');
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(Category $category)
    {
        Gate::authorize('manage-categories');
        DB::table('posts')
            ->where('category_id', $category->id)
            ->update(['category_id' => null]);

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée.');
    }
}
