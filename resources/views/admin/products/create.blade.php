@extends('adminlte::page')

@section('title', 'New Product')

@section('content_header')
    <h1 class="m-0">New Product</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}">
                @include('admin.products._form')
            </form>
        </div>
    </div>
@stop
