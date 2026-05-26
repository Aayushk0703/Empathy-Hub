@extends('adminlte::page')

@section('title', 'Edit Service')

@section('content_header')
    <h1 class="m-0">Edit Service #{{ $service->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.update', $service) }}">
                @method('PUT')
                @include('admin.services._form', ['service' => $service])
            </form>
        </div>
    </div>
@stop
