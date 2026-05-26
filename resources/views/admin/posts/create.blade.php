@extends('adminlte::page')

@section('title', 'New Post')

@section('content_header')
    <h1 class="m-0">New Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.store') }}">
                @include('admin.posts._form')
            </form>
        </div>
    </div>
@stop
