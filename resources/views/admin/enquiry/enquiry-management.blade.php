@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Enquiry
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Enquiry</a></li>
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
                            <h3 class="box-title">Enquiry Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/enquiry-management/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Enquiry
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Image/Pdf</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enquiries as $index => $enquiry)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($enquiry->attachment)
                                                    @php
                                                        $ext = strtolower(
                                                            pathinfo($enquiry->attachment, PATHINFO_EXTENSION),
                                                        );
                                                    @endphp

                                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                        <a href="{{ asset($enquiry->attachment) }}" target="_blank">
                                                            <img src="{{ asset($enquiry->attachment) }}" width="80"
                                                                height="60" alt="Attachment">
                                                        </a>
                                                    @elseif ($ext === 'pdf')
                                                        <a href="{{ asset($enquiry->attachment) }}" target="_blank">View
                                                            PDF</a>
                                                    @else
                                                        <span>No Preview</span>
                                                    @endif
                                                @else
                                                    <span>No File</span>
                                                @endif
                                            </td>


                                            <td>{{ $enquiry->name }}</td>
                                            <td>{{ $enquiry->phone ?? '-' }}</td>
                                            <td>{{ $enquiry->email }}</td>
                                            <td>{{ $enquiry->subject ?? '-' }}</td>
                                            <td>{{ $enquiry->message }}</td>
                                            <td>
                                                <a href="{{ route('enquiry.edit_enquiry', $enquiry->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>

                                                <a href="{{ route('enquiry.delete_enquiry', $enquiry->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this enquiry?')">
                                                    Delete
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Image/Pdf</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
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
