@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1 class="m-0">Edit Post #{{ $post->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.update', $post) }}">
                @method('PUT')
                @include('admin.posts._form', ['post' => $post])
            </form>
        </div>
    </div>
@stop
