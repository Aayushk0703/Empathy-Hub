@extends('adminlte::page')

@section('title', 'Media Library')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Media Library</h1>
        <a class="btn btn-primary" href="{{ route('admin.media.create') }}">
            <i class="fas fa-upload"></i> Upload
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($media as $m)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                        <a href="{{ route('admin.media.show', $m) }}" class="d-block text-decoration-none">
                            <div class="border rounded p-2 text-center" style="height: 150px; overflow: hidden;">
                                @if(str_starts_with((string)$m->mime_type, 'image/'))
                                    <img src="{{ asset('storage/'.$m->path) }}" alt="{{ $m->original_name }}"
                                         style="max-width: 100%; max-height: 120px; object-fit: contain;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center" style="height: 120px;">
                                        <i class="far fa-file-pdf fa-3x text-danger"></i>
                                    </div>
                                @endif
                                <div class="small text-muted text-truncate mt-1">{{ $m->original_name }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted p-5">No media uploaded yet.</div>
                @endforelse
            </div>
        </div>
        @if($media->hasPages())
            <div class="card-footer">
                {{ $media->links() }}
            </div>
        @endif
    </div>
@stop
