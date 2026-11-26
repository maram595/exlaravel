<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Arr;
class PostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'heading' => 'Tous les articles',
            'posts' => Post::with('user', 'category', 'tags')->latest('id')->paginate(4),
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
    return view('posts.create', [
        'categories' => Category::orderBy('name')->get(),
        'tags' => Tag::orderBy('name')->get(),
    ]);
}

public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:posts,slug'],
        'body' => ['required', 'string', 'min:20'],
        'is_published' => ['nullable', 'boolean'],
        'excerpt' => ['nullable', 'string', 'max:255'],
        'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        'tags' => ['nullable', 'array'],
'tags.*' => ['integer', 'exists:tags,id']
    ]);

    $validated['is_published'] = $request->boolean('is_published');
    $validated['published_at'] = $validated['is_published'] ? now() : null;

    $post = Post::create($validated);

    return redirect()->route('posts.show', $post);
}


public function show(Post $post): View
{
    $post->load('user', 'category', 'tags');

    return view('posts.show', compact('post'));
}

public function edit(Post $post): View
{
    $post->load('tags');

    return view('posts.edit', [
        'post' => $post,
        'categories' => Category::orderBy('name')->get(),
        'tags' => Tag::orderBy('name')->get(),
    ]);
}
public function update(Request $request, Post $post): RedirectResponse
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'slug' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-z0-9-]+$/',
            Rule::unique('posts', 'slug')->ignore($post),
        ],
        
        'excerpt' => ['nullable', 'string', 'max:255'],
        'body' => ['required', 'string', 'min:20'],
        'is_published' => ['nullable', 'boolean'],
        'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        'tags' => ['nullable', 'array'],
'tags.*' => ['integer', 'exists:tags,id']
    ]);

    $validated['is_published'] = $request->boolean('is_published');

    $validated['published_at'] = $validated['is_published']
        ? ($post->published_at ?? now())
        : null;
$post->update(Arr::except($validated, ['tags']));

$post->tags()->sync($validated['tags'] ?? []);
    $post->update($validated);

    return redirect()->route('posts.show', $post);
}

 public function destroy(Post $post): RedirectResponse
{
    $post->delete();

    return redirect()->route('posts.index');
}
public function byCategory(Category $category): View
{
    return view('posts.index', [
        'heading' => 'Catégorie : '.$category->name,
        'posts' => $category->posts()
            ->published()
            ->with('user', 'category', 'tags')
            ->latest('published_at')
            ->paginate(4),
    ]);
}
}
