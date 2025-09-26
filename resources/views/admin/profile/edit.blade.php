@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>User Profile</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">User profile</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $admin->email }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Number</label>
                                    <input type="text" name="number" class="form-control" value="{{ $admin->number }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture</label><br>
                                    @if ($admin->profile_picture)
                                        <img src="{{ asset('admin/uploads/' . $admin->profile_picture) }}" width="100" class="img-thumbnail mb-2"><br>
                                    @endif
                                    <input type="file" name="profile_picture" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea name="bio" class="form-control" rows="3">{{ $admin->bio }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Post Gallery (JSON)</label>
                                    <textarea name="post_gallery" class="form-control" rows="3">{{ $admin->post_gallery }}</textarea>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
