@extends('adminlte::page')

@section('title', 'New Service')

@section('content_header')
    <h1 class="m-0">New Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @include('admin.services._form')
            </form>
        </div>
    </div>
@stop
