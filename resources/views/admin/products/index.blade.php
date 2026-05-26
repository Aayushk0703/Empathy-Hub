@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Products</h1>
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
            <i class="fas fa-plus"></i> New Product
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
                    <th>Name</th>
                    <th>Price</th>
                    <th>Active</th>
                    <th>SKU</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $product->name }}</div>
                            <small class="text-muted">{{ $product->slug }}</small>
                        </td>
                        <td>{{ $product->currency }} {{ number_format((float)$product->price, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ $product->is_active ? 'success' : 'secondary' }}">
                                {{ $product->is_active ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>{{ $product->sku ?? '-' }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.products.show', $product) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                  onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-muted">No products yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@stop
