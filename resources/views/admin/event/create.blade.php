@extends('admin.layout.layouts')
@section('content')
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>Create Event <small>Management</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Events</a></li>
                <li class="active">Create</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Event</h3>
                </div>

                <div class="box-body">
                    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Label</label>
                                    <input type="text" name="label" class="form-control" value="{{ old('label') }}">
                                </div>

                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Reported At</label>
                                    <input type="datetime-local" name="reported_at" class="form-control"
                                        value="{{ old('reported_at') }}">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Main Media (Image or Video)</label>
                                    <input type="file" name="media" class="form-control" accept="image/*,video/*">
                                    <small class="text-muted">Allowed: jpg, jpeg, png, gif, mp4, mov, avi, wmv (Max:
                                        10MB)</small>
                                </div>

                                <div class="form-group">
                                    <label>Gallery Images</label>
                                    <input type="file" name="media_gallery[]" class="form-control" multiple
                                        accept="image/*">
                                    <small class="text-muted">You can select multiple image files</small>
                                </div>

                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control"
                                        value="{{ old('latitude') }}">
                                </div>

                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control"
                                        value="{{ old('longitude') }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Create Event</button>
                    </form>



                </div>
            </div>
        </section>
    </div>
@endsection
