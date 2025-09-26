@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Event
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Event</a></li>
                <li class="active">Management</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Event Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/event-management/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Event
                                </a>

                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Title</th>
                                        <th>Lebel</th>
                                        <th>latitude</th>
                                        <th>longitude</th>
                                        <th>Media</th>
                                        <th>Reported At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $index => $event)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->label }}</td>
                                            <td>{{ $event->latitude }}</td>
                                            <td>{{ $event->longitude }}</td>
                                            <td>
                                                @if ($event->media_path)
                                                    @if ($event->media_type == 'image')
                                                        <img src="{{ asset('admin/uploads/event/' . $event->media_path) }}"
                                                            width="80" />
                                                    @else
                                                        <video width="100" controls>
                                                            <source
                                                                src="{{ asset('admin/uploads/event/' . $event->media_path) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @else
                                                    No Media
                                                @endif
                                            </td>
                                            <td>{{ $event->reported_at }}</td>
                                            <td>
                                                <a href="{{ route('event.toggleStatus', $event->id) }}"
                                                    class="badge bg-{{ $event->status == 'active' ? 'success' : 'danger' }} text-white"
                                                    onclick="return confirm('Are you sure you want to change the status?')">
                                                    {{ $event->status == 'active' ? 'Available' : 'Unavailable' }}
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ route('event.edit_event', $event->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('event.delete_event', $event->id) }}"
                                                    onclick="return confirm('Are you sure?')"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>1</td>
                                        <td>title</td>
                                        <td>lebel</td>
                                        <td>latitude</td>
                                        <td>longitude</td>
                                        <td>Media</td>
                                        <td>Reported At</td>
                                        <td>
                                            Status
                                        </td>
                                        <td>Action</td>
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
