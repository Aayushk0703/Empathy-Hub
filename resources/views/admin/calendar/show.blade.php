@extends('adminlte::page')

@section('title', 'View Event')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Event #{{ $calendarEvent->id }}</h1>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.calendar.edit', $calendarEvent) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('admin.calendar.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-2">Title</dt>
                <dd class="col-sm-10">{{ $calendarEvent->title }}</dd>
                <dt class="col-sm-2">Type</dt>
                <dd class="col-sm-10">{{ $calendarEvent->event_type }}</dd>
                <dt class="col-sm-2">Location</dt>
                <dd class="col-sm-10">{{ $calendarEvent->location ?? '-' }}</dd>
                <dt class="col-sm-2">All day</dt>
                <dd class="col-sm-10">{{ $calendarEvent->is_all_day ? 'Yes' : 'No' }}</dd>
                <dt class="col-sm-2">Start</dt>
                <dd class="col-sm-10">{{ optional($calendarEvent->start_at)->toDayDateTimeString() }}</dd>
                <dt class="col-sm-2">End</dt>
                <dd class="col-sm-10">{{ optional($calendarEvent->end_at)->toDayDateTimeString() ?? '-' }}</dd>
                <dt class="col-sm-2">Description</dt>
                <dd class="col-sm-10" style="white-space: pre-wrap;">{{ $calendarEvent->description ?? '-' }}</dd>
            </dl>
        </div>
    </div>
@stop
