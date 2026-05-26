@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content_header')
    <h1 class="m-0">Edit Product #{{ $product->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @method('PUT')
                @include('admin.products._form', ['product' => $product])
            </form>
        </div>
    </div>
@stop
