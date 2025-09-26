@extends('front.layouts.main')
@section('content')
    <section class="difference-section py-0">
        <div class="container py-5 ">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="contact-wrapper">
                        <div class="row g-0">
                            <div class="col-lg-12 text-center">
                                <h2 class="heading">{!! __('messages.contact_title') !!}</h2>
                                <p style="font-size: 15px;">{!! __('messages.contact_desc') !!}</p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-7 col-md-12 ">
                                <div class="contact-form">

                                    <form id="enquiryForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter your full name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Enter your Email Address" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Subject / Topic</label>
                                                <input type="text" name="subject" class="form-control"
                                                    placeholder="General Inquiry" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Attachment</label>
                                                <input type="file" name="attachment" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label>Your Message</label>
                                            <textarea class="form-control" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                                        </div>

                                        <button type="submit" class="btn-primary-hero">Send Message</button>
                                    </form>

                                    <div id="successMessage" style="display: none;" class="alert alert-success mt-3">
                                        Your message has been sent successfully!
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <img src="{{ asset('front/asset/img/contact.png') }}" alt="" height="100%"
                                    width="522px" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
<script>
$('#enquiryForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('enquiry-form.storeDetails') }}", // must match route name
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status === 'success') {
                $('#successMessage').fadeIn();
                $('#enquiryForm')[0].reset();
                setTimeout(function() { $('#successMessage').fadeOut(); }, 3000);
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = '';
            $.each(errors, function(key, value) {
                errorMessage += value[0] + "\n";
            });
            alert(errorMessage);
        }
    });
});

</script>
@endpush
@endsection
