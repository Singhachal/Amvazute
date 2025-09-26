@extends('admin.layout.layouts')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create New Contact
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Contact Management</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Contact</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-remove"></i></button>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('admin.contact.store') }}" method="POST" class="w-100">
                            @csrf

                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Primary Email</label>
                                    <input type="email" name="primary_email" value="{{ old('primary_email') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Alternative Email</label>
                                    <input type="email" name="alternative_email" value="{{ old('alternative_email') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Primary Number</label>
                                    <input type="number" name="primary_number" value="{{ old('primary_number') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Alternative Number</label>
                                    <input type="number" name="alternative_number" value="{{ old('alternative_number') }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Map (Google Maps Embed URL)</label>
                                    <input type="text" name="map" class="form-control" value="{{ old('map') }}"
                                        placeholder="Paste Google Maps Embed URL here">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>LinkedIn</label>
                                    <input type="url" name="linkedin" class="form-control"
                                        value="{{ old('linkedin') }}">
                                </div>

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="url" name="facebook" class="form-control"
                                        value="{{ old('facebook') }}">
                                </div>
                            </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="url" name="instagram" class="form-control"
                                        value="{{ old('instagram') }}">
                                </div>

                                <div class="form-group">
                                    <label>Twitter (X)</label>
                                    <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success">Create User</button>
                        </form>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection
