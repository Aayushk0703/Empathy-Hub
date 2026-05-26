@extends('adminlte::page')

@section('title', 'View Product')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Product #{{ $product->id }}</h1>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $product->name }}</dd>
                        <dt class="col-sm-3">Slug</dt>
                        <dd class="col-sm-9"><code>{{ $product->slug }}</code></dd>
                        <dt class="col-sm-3">Price</dt>
                        <dd class="col-sm-9">{{ $product->currency }} {{ number_format((float)$product->price, 2) }}</dd>
                        <dt class="col-sm-3">Stock</dt>
                        <dd class="col-sm-9">{{ $product->stock ?? '-' }}</dd>
                        <dt class="col-sm-3">SKU</dt>
                        <dd class="col-sm-9">{{ $product->sku ?? '-' }}</dd>
                        <dt class="col-sm-3">Active</dt>
                        <dd class="col-sm-9">{{ $product->is_active ? 'Yes' : 'No' }}</dd>
                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9" style="white-space: pre-wrap;">{{ $product->description ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Image</h3></div>
                <div class="card-body text-center">
                    @if($product->media && str_starts_with((string)$product->media->mime_type, 'image/'))
                        <img src="{{ asset('storage/'.$product->media->path) }}" alt="{{ $product->media->original_name }}"
                             style="max-width: 100%; height: auto;">
                        <div class="small text-muted mt-2">{{ $product->media->original_name }}</div>
                    @else
                        <div class="text-muted">No image selected.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
