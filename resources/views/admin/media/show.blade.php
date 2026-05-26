@extends('adminlte::page')

@section('title', 'View Media')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Media #{{ $media->id }}</h1>
        <div>
            <a class="btn btn-secondary" href="{{ route('admin.media.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center">
                    @if(str_starts_with((string)$media->mime_type, 'image/'))
                        <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $media->original_name }}"
                             style="max-width: 100%; height: auto;">
                    @else
                        <iframe src="{{ asset('storage/'.$media->path) }}" style="width: 100%; height: 70vh;"></iframe>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">File</dt>
                        <dd class="col-sm-8">{{ $media->original_name }}</dd>
                        <dt class="col-sm-4">MIME</dt>
                        <dd class="col-sm-8">{{ $media->mime_type }}</dd>
                        <dt class="col-sm-4">Size</dt>
                        <dd class="col-sm-8">{{ number_format(($media->size ?? 0) / 1024, 1) }} KB</dd>
                        <dt class="col-sm-4">Path</dt>
                        <dd class="col-sm-8"><code>{{ $media->path }}</code></dd>
                        <dt class="col-sm-4">URL</dt>
                        <dd class="col-sm-8">
                            <a href="{{ asset('storage/'.$media->path) }}" target="_blank">Open</a>
                        </dd>
                    </dl>

                    <hr>
                    <form method="POST" action="{{ route('admin.media.destroy', $media) }}"
                          onsubmit="return confirm('Delete this file?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
