<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
public function index(Request $request): View
{
    $posts = Post::visibleTo($request->user())
        ->with('user', 'category', 'tags')
        ->latest('id')
        ->paginate(4);

    return view('posts.index', [
    'posts' => $posts,
    'heading' => 'Tous les articles',
]);
}
    public function archive(string $year): View
    {
        return view('posts.index', [
            'heading' => 'Articles de '.$year,
            'posts' => Post::published()
                ->with('user', 'category', 'tags')
                ->whereYear('published_at', $year)
                ->latest('id')
                ->paginate(4),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', Post::class);
        return view('posts.create', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function store(StorePostRequest $request): RedirectResponse
{
    $validated = $request->validated();

    $validated['is_published'] = $request->boolean('is_published');
    $validated['published_at'] = $validated['is_published'] ? now() : null;

    // CrÃ©er l'article pour l'utilisateur connectÃ©
    $post = $request->user()->posts()->create(
        Arr::except($validated, ['tags'])

    );

    // Associer les tags
    $post->tags()->sync($validated['tags'] ?? []);

    return redirect()
        ->route('posts.show', $post)
        ->with('success', 'Article crÃ©Ã©.');
}
    public function show(Post $post): View
    {
        Gate::authorize('view', $post);
        $post->load('user', 'category', 'tags');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
        $post->load('tags');

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
        $validated = $request->validated();

        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published']
            ? ($post->published_at ?? now())
            : null;

        $post->update(Arr::except($validated, ['tags']));
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()
    ->route('posts.show', $post)
    ->with('success', 'Article modifiÃ©.');
    }

public function destroy(Post $post): RedirectResponse
{
    $this->authorize('delete', $post);

    $post->tags()->detach();
    $post->delete();

    return redirect()
        ->route('posts.index')
        ->with('success', 'Article supprimÃ©.');
}

    public function byCategory(Category $category): View
    {
        return view('posts.index', [
            'heading' => 'CatÃ©gorie : '.$category->name,
            'posts' => $category->posts()
                ->published()
                ->with('user', 'category', 'tags')
                ->latest('published_at')
                ->paginate(4),
        ]);
    }
    public function togglePublication(Post $post): RedirectResponse
{
    $this->authorize('update', $post);
    $isPublished = ! $post->is_published;

    $post->update([
        'is_published' => $isPublished,
        'published_at' => $isPublished ? now() : null,
    ]);

    return redirect()
        ->route('posts.show', $post)
        ->with('success', $isPublished ? 'Article publiÃ©.' : 'Article dÃ©publiÃ©.');
}
}
