@csrf

<div class="form-group">
    <label>Title</label>
    <input name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $post->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Slug (optional)</label>
    <input name="slug" class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $post->slug ?? '') }}">
    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Excerpt</label>
    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Body</label>
    <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="8" required>{{ old('body', $post->body ?? '') }}</textarea>
    @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            @php($val = old('status', $post->status ?? 'draft'))
            <option value="draft" {{ $val === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ $val === 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ $val === 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-4">
        <label>Published at (optional)</label>
        <input type="datetime-local" name="published_at" class="form-control @error('published_at') is-invalid @enderror"
               value="{{ old('published_at', optional(($post->published_at ?? null))->format('Y-m-d\\TH:i')) }}">
        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<button class="btn btn-primary" type="submit">Save</button>
<a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Cancel</a>
