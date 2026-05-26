@csrf

<div class="form-group">
    <label>Name</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $product->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Slug (optional)</label>
    <input name="slug" class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $product->slug ?? '') }}">
    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $product->price ?? 0) }}" min="0" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-2">
        <label>Currency</label>
        <input name="currency" class="form-control @error('currency') is-invalid @enderror"
               value="{{ old('currency', $product->currency ?? 'INR') }}" maxlength="3" required>
        @error('currency') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Stock (optional)</label>
        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $product->stock ?? '') }}" min="0">
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>SKU (optional)</label>
        <input name="sku" class="form-control @error('sku') is-invalid @enderror"
               value="{{ old('sku', $product->sku ?? '') }}">
        @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Active</label>
        @php($active = old('is_active', isset($product) ? (int)$product->is_active : 1))
        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
            <option value="1" {{ (string)$active === '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ (string)$active === '0' ? 'selected' : '' }}>No</option>
        </select>
        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-8">
        <label>Image (optional, from Media Library)</label>
        <select name="media_id" class="form-control @error('media_id') is-invalid @enderror">
            <option value="">-- none --</option>
            @php($selected = old('media_id', $product->media_id ?? ''))
            @foreach(($media ?? []) as $m)
                <option value="{{ $m->id }}" {{ (string)$selected === (string)$m->id ? 'selected' : '' }}>
                    #{{ $m->id }} - {{ $m->original_name }}
                </option>
            @endforeach
        </select>
        @error('media_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted d-block mt-1">Upload images in Media Library first, then pick them here.</small>
    </div>
</div>

<button class="btn btn-primary" type="submit">Save</button>
<a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Cancel</a>
