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
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Contact</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ url('admin/contact-management/update/' . $contact->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Primary Email</label>
                                        <input type="email" name="primary_email" value="{{ $contact->primary_email }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Alternative Email</label>
                                        <input type="email" name="alternative_email"
                                            value="{{ $contact->alternative_email }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ $contact->address }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>LinkedIn</label>
                                        <input type="url" name="linkedin" value="{{ $contact->linkedin }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="url" name="facebook" value="{{ $contact->facebook }}"
                                            class="form-control">
                                    </div>


                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Primary Number</label>
                                        <input type="text" name="primary_number" value="{{ $contact->primary_number }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Alternative Number</label>
                                        <input type="text" name="alternative_number"
                                            value="{{ $contact->alternative_number }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Map (Google Map Embed URL)</label>
                                        <input type="text" name="map" value="{{ $contact->map }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="url" name="twitter" value="{{ $contact->twitter }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="url" name="instagram" value="{{ $contact->instagram }}"
                                            class="form-control">
                                    </div>



                                </div>

                                <!-- Submit Button (Full Width) -->
                                <div class="col-md-12 text-right mt-3">
                                    <button type="submit" class="btn btn-success">Update Contact</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </section>
    </div>
@endsection
