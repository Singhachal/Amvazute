<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
class EnquiryController extends Controller
{
    public function enquiry()
    {
        $enquiries = Enquiry::latest()->get(); // fetch all enquiries
        return view('admin.enquiry.enquiry-management', compact('enquiries'));
    }

    public  function create()
    {
        return view('admin.enquiry.create');
    }


public function storeEnquiry(Request $request)
{

    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'phone'     => 'nullable|string|max:20',
        'subject'   => 'nullable|string|max:255',
        'message'   => 'required|string',
        'attachment'=> 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);


    $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);


    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('admin/uploads/enquiries'), $filename);
        $data['attachment'] = $filename; // ✅ Only the filename stored
    }


    $data['status'] = 0;


    Enquiry::create($data);


    return redirect()->back()->with('success', 'Enquiry submitted successfully!');
}

public function editenquiry($id)
{
    $enquiry = Enquiry::findOrFail($id);
    return view('admin.enquiry.edit', compact('enquiry'));
}


public function updateenquiry(Request $request, $id)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'phone'     => 'nullable|string|max:20',
        'subject'   => 'nullable|string|max:255',
        'message'   => 'required|string',
        'attachment'=> 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $enquiry = Enquiry::findOrFail($id);

    $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);

    if ($request->hasFile('attachment')) {
        // delete old file if exists
        if ($enquiry->attachment && file_exists(public_path($enquiry->attachment))) {
            unlink(public_path($enquiry->attachment));
        }

        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('admin/uploads/enquiries'), $filename);
        $data['attachment'] = 'admin/uploads/enquiries/' . $filename;
    }

    $enquiry->update($data);


    return redirect()->back()->with('success', 'Enquiry updated successfully!');
}


public function deleteenquiry($id)
{
    $enquiry = Enquiry::findOrFail($id);

    if ($enquiry->attachment && file_exists(public_path($enquiry->attachment))) {
        unlink(public_path($enquiry->attachment));
    }

    $enquiry->delete();

    return redirect()->back()->with('success', 'Enquiry deleted successfully!');
}




}
