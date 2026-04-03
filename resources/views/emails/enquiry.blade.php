<h2>New Enquiry</h2>

<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Subject:</strong> {{ $data['subject'] }}</p>
<p><strong>Message:</strong> {{ $data['message'] }}</p>

@if(isset($data['attachment']))
<p><strong>Attachment:</strong> {{ asset($data['attachment']) }}</p>
@endif