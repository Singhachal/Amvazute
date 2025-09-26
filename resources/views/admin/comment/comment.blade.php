@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Comment
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Comment</a></li>
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
                            <h3 class="box-title">Comment Management</h3>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>User Name</th>
                                        <th>Post Name</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $index => $comment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $comment->user_id ?? 'N/A' }}</td>
                                            <td>{{ $comment->post_id ?? 'N/A' }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>
                                                <a href="{{ route('comment.toggleStatus', $comment->id) }}"
                                                    class="badge {{ $comment->status == 1 ? 'bg-success' : 'bg-warning text-dark' }}"
                                                    onclick="return confirm('Are you sure you want to change the status?')">
                                                    {{ $comment->status == 1 ? 'Approved' : 'Pending' }}
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>User Name</th>
                                        <th>Post Name</th>
                                        <th>Comment</th>
                                        <th>Status</th>
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
