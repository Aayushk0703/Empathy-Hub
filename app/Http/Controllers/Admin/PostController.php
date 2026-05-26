<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\AdminActivityLogger;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()
            ->with('author')
            ->latest('id')
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        $post = Post::create($data);
        AdminActivityLogger::log(
            $request->user(),
            'posts',
            'create',
            'Created post: '.$post->title,
            Post::class,
            $post->id,
            ['slug' => $post->slug],
            $request
        );

        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && empty($data['published_at']) && $post->published_at === null) {
            $data['published_at'] = now();
        }

        if (isset($data['slug']) && $data['slug'] !== $post->slug) {
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $post->id);
        }

        $post->update($data);
        AdminActivityLogger::log(
            $request->user(),
            'posts',
            'update',
            'Updated post: '.$post->title,
            Post::class,
            $post->id,
            ['slug' => $post->slug],
            $request
        );

        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;
        $postId = $post->id;
        $post->delete();
        AdminActivityLogger::log(
            request()->user(),
            'posts',
            'delete',
            'Deleted post: '.$title,
            Post::class,
            $postId,
            null,
            request()
        );
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $i = 2;

        while (
            Post::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base.'-'.$i;
            $i++;
        }

        return $candidate;
    }
}
