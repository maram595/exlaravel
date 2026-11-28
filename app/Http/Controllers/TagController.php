<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-tags');

        $tags = Tag::orderBy('name')->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        Gate::authorize('manage-tags');

        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        Gate::authorize('manage-tags');

        Tag::create($request->validated());

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag créé.');
    }

    public function edit(Tag $tag)
    {
        Gate::authorize('manage-tags');

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        Gate::authorize('manage-tags');

        $tag->update($request->validated());

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag mis à jour.');
    }

    public function destroy(Tag $tag)
    {
        Gate::authorize('manage-tags');

        $tag->posts()->detach();
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag supprimé.');
    }
}