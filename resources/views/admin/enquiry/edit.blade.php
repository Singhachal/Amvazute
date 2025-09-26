@extends('admin.layout.layouts')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Enquiry</h1>
    </section>

    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('success') }}
            </div>
        @endif

    <section class="content">
        <form action="{{ route('enquiry.update_enquiry', $enquiry->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Full Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $enquiry->name }}" class="form-control" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $enquiry->email }}" class="form-control" required>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ $enquiry->phone }}" class="form-control">
                    </div>
                </div>

                <!-- Subject -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" value="{{ $enquiry->subject }}" class="form-control">
                    </div>
                </div>

                <!-- Message -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="4" required>{{ $enquiry->message }}</textarea>
                    </div>
                </div>

                <!-- Existing Attachment -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Existing Attachment</label><br>
                        @if ($enquiry->attachment)
                            <a href="{{ asset($enquiry->attachment) }}" target="_blank">View File</a>
                        @else
                            No File Uploaded
                        @endif
                    </div>
                </div>

                <!-- New Attachment -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Change Attachment</label>
                        <input type="file" name="attachment" class="form-control">
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Update Enquiry</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
