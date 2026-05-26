@extends('adminlte::page')

@section('title', 'Upload Media')

@section('content_header')
    <h1 class="m-0">Upload</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Select file (jpg/png/webp/gif/pdf, max 5MB)</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Upload</button>
                <a class="btn btn-secondary" href="{{ route('admin.media.index') }}">Back</a>
            </form>
        </div>
    </div>
@stop
