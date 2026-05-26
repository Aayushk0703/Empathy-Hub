@csrf

<div class="form-group">
    <label>Title</label>
    <input name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $service->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Slug (optional)</label>
    <input name="slug" class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $service->slug ?? '') }}">
    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Icon (FontAwesome class, optional)</label>
        <input name="icon" class="form-control @error('icon') is-invalid @enderror"
               value="{{ old('icon', $service->icon ?? '') }}" placeholder="e.g. fas fa-graduation-cap">
        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Sort order</label>
        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
               value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Active</label>
        @php($active = old('is_active', isset($service) ? (int)$service->is_active : 1))
        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
            <option value="1" {{ (string)$active === '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ (string)$active === '0' ? 'selected' : '' }}>No</option>
        </select>
        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<button class="btn btn-primary" type="submit">Save</button>
<a class="btn btn-secondary" href="{{ route('admin.services.index') }}">Cancel</a>
