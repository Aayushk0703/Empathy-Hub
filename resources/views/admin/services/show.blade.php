@extends('adminlte::page')

@section('title', 'View Service')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Service #{{ $service->id }}</h1>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.services.edit', $service) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('admin.services.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-2">Title</dt>
                <dd class="col-sm-10">{{ $service->title }}</dd>

                <dt class="col-sm-2">Slug</dt>
                <dd class="col-sm-10"><code>{{ $service->slug }}</code></dd>

                <dt class="col-sm-2">Active</dt>
                <dd class="col-sm-10">{{ $service->is_active ? 'Yes' : 'No' }}</dd>

                <dt class="col-sm-2">Sort</dt>
                <dd class="col-sm-10">{{ $service->sort_order }}</dd>

                <dt class="col-sm-2">Icon</dt>
                <dd class="col-sm-10">{{ $service->icon ?? '-' }}</dd>

                <dt class="col-sm-2">Description</dt>
                <dd class="col-sm-10" style="white-space: pre-wrap;">{{ $service->description ?? '-' }}</dd>
            </dl>
        </div>
    </div>
@stop
