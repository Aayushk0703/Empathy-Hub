@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Posts</h1>
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">
            <i class="fas fa-plus"></i> New Post
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Published</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $post->title }}</div>
                            <small class="text-muted">{{ $post->slug }}</small>
                        </td>
                        <td>
                            <span class="badge badge-{{ $post->status === 'published' ? 'success' : ($post->status === 'archived' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td>{{ optional($post->author)->name }}</td>
                        <td>{{ optional($post->published_at)->format('Y-m-d') ?? '-' }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.posts.show', $post) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                  onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-muted">No posts yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
            <div class="card-footer">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@stop
