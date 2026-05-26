@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h1 class="m-0">Edit Event #{{ $calendarEvent->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.calendar.update', $calendarEvent) }}">
                @method('PUT')
                @include('admin.calendar._form', ['calendarEvent' => $calendarEvent])
            </form>
        </div>
    </div>
@stop
