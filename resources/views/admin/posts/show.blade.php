@extends('adminlte::page')

@section('title', 'View Post')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Post #{{ $post->id }}</h1>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-2">Title</dt>
                <dd class="col-sm-10">{{ $post->title }}</dd>

                <dt class="col-sm-2">Slug</dt>
                <dd class="col-sm-10"><code>{{ $post->slug }}</code></dd>

                <dt class="col-sm-2">Status</dt>
                <dd class="col-sm-10">{{ ucfirst($post->status) }}</dd>

                <dt class="col-sm-2">Published</dt>
                <dd class="col-sm-10">{{ optional($post->published_at)->toDayDateTimeString() ?? '-' }}</dd>

                <dt class="col-sm-2">Excerpt</dt>
                <dd class="col-sm-10">{{ $post->excerpt ?? '-' }}</dd>

                <dt class="col-sm-2">Body</dt>
                <dd class="col-sm-10" style="white-space: pre-wrap;">{{ $post->body }}</dd>
            </dl>
        </div>
    </div>
@stop
