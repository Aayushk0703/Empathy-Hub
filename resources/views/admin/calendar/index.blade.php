@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Calendar</h1>
        <a class="btn btn-primary" href="{{ route('admin.calendar.create') }}">
            <i class="fas fa-plus"></i> New Event
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
                    <th style="width:70px;">ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>All day</th>
                    <th style="width:220px;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $e)
                    <tr>
                        <td>{{ $e->id }}</td>
                        <td class="font-weight-bold">{{ $e->title }}</td>
                        <td>{{ $e->event_type }}</td>
                        <td>{{ optional($e->start_at)->format('Y-m-d H:i') }}</td>
                        <td>{{ optional($e->end_at)->format('Y-m-d H:i') ?? '-' }}</td>
                        <td>{{ $e->is_all_day ? 'Yes' : 'No' }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.calendar.show', $e) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.calendar.edit', $e) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.calendar.destroy', $e) }}"
                                  onsubmit="return confirm('Delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-muted">No events yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($events->hasPages())
            <div class="card-footer">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@stop
