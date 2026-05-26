@extends('adminlte::page')

@section('title', 'New Event')

@section('content_header')
    <h1 class="m-0">New Event</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.calendar.store') }}">
                @include('admin.calendar._form')
            </form>
        </div>
    </div>
@stop
