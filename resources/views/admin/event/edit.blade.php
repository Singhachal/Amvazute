@extends('admin.layout.layouts')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Event</h1>
    </section>

    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <section class="content">
        <form action="{{ route('event.update_event', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Left -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label" class="form-control" value="{{ old('label', $event->label) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $event->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Reported At</label>
                        <input type="datetime-local" name="reported_at" class="form-control"
                            value="{{ old('reported_at', $event->reported_at ? \Carbon\Carbon::parse($event->reported_at)->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>

                <!-- Right -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Replace Media (Image or Video)</label>
                        <input type="file" name="media" class="form-control">
                        @if($event->media_path)
                            <small>Current: {{ $event->media_path }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Upload New Gallery Media (Images or Videos)</label>
                        <input type="file" name="media_gallery[]" class="form-control" multiple accept="image/*,video/*">
                        <small class="text-muted">You can upload multiple files: images (jpg, png, gif) or videos (mp4, mov, avi, wmv)</small>
                    </div>


                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" value="{{ old('latitude', $event->latitude) }}">
                    </div>

                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" value="{{ old('longitude', $event->longitude) }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </section>
</div>
@endsection
