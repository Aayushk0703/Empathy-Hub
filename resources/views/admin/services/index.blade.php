@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Services</h1>
        <a class="btn btn-primary" href="{{ route('admin.services.create') }}">
            <i class="fas fa-plus"></i> New Service
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
                    <th>Active</th>
                    <th>Sort</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $service->title }}</div>
                            <small class="text-muted">{{ $service->slug }}</small>
                        </td>
                        <td>
                            <span class="badge badge-{{ $service->is_active ? 'success' : 'secondary' }}">
                                {{ $service->is_active ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>{{ $service->sort_order }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.services.show', $service) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.services.edit', $service) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                  onsubmit="return confirm('Delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-muted">No services yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
            <div class="card-footer">
                {{ $services->links() }}
            </div>
        @endif
    </div>
@stop
