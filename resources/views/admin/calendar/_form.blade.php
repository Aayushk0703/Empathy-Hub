@csrf

<div class="form-group">
    <label>Title</label>
    <input name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $calendarEvent->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $calendarEvent->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Type</label>
        <input name="event_type" class="form-control @error('event_type') is-invalid @enderror"
               value="{{ old('event_type', $calendarEvent->event_type ?? 'general') }}" required>
        @error('event_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Examples: general, holiday, exam, admission</small>
    </div>
    <div class="form-group col-md-4">
        <label>Location (optional)</label>
        <input name="location" class="form-control @error('location') is-invalid @enderror"
               value="{{ old('location', $calendarEvent->location ?? '') }}">
        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-4">
        <label>All day</label>
        @php($allDay = old('is_all_day', isset($calendarEvent) ? (int)$calendarEvent->is_all_day : 0))
        <select name="is_all_day" class="form-control @error('is_all_day') is-invalid @enderror">
            <option value="0" {{ (string)$allDay === '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ (string)$allDay === '1' ? 'selected' : '' }}>Yes</option>
        </select>
        @error('is_all_day') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Start</label>
        <input type="datetime-local" name="start_at" class="form-control @error('start_at') is-invalid @enderror"
               value="{{ old('start_at', optional(($calendarEvent->start_at ?? null))->format('Y-m-d\\TH:i')) }}" required>
        @error('start_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-6">
        <label>End (optional)</label>
        <input type="datetime-local" name="end_at" class="form-control @error('end_at') is-invalid @enderror"
               value="{{ old('end_at', optional(($calendarEvent->end_at ?? null))->format('Y-m-d\\TH:i')) }}">
        @error('end_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<button class="btn btn-primary" type="submit">Save</button>
<a class="btn btn-secondary" href="{{ route('admin.calendar.index') }}">Cancel</a>
