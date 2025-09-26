@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Contact
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Contact</a></li>
                <li class="active">Management</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Contact Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/contact-management/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Contact
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Primary Email</th>
                                        <th>Alternative Email</th>
                                        <th>Primary Number</th>
                                        <th>Alternative Number</th>
                                        <th>Address</th>
                                        <th>Map</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $index => $contact)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $contact->primary_email }}</td>
                                            <td>{{ $contact->alternative_email }}</td>
                                            <td>{{ $contact->primary_number }}</td>
                                            <td>{{ $contact->alternative_number }}</td>
                                            <td>{{ $contact->address }}</td>
                                            <td>
                                                @if ($contact->map)
                                                    <a href="{{ $contact->map }}" target="_blank">View Map</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/contact-management/edit/' . $contact->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ url('admin/contact-management/delete/' . $contact->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Primary Email</th>
                                        <th>Alternative Email</th>
                                        <th>Primary Number</th>
                                        <th>Alternative Number</th>
                                        <th>Address</th>
                                        <th>Map</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
