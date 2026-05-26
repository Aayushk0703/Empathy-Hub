<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;

class PublicContentController extends Controller
{
    public function services()
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'description', 'icon']);

        return response()->json([
            'services' => $services,
        ]);
    }

    public function posts()
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(12)
            ->get()
            ->map(function (Post $post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => $post->excerpt ?: str($post->body)->stripTags()->limit(160)->value(),
                    'body' => $post->body,
                    'published_at' => optional($post->published_at)->toDateString(),
                ];
            });

        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function post(string $slug)
    {
        $post = Post::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();

        return response()->json([
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt ?: str($post->body)->stripTags()->limit(160)->value(),
                'body' => $post->body,
                'published_at' => optional($post->published_at)->toDateString(),
            ],
        ]);
    }
}
