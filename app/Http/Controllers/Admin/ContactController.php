<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function ContactManagement()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view('admin.ContactManagement.contact-management', compact('contacts'));
    }

    public  function create()
    {
        return view('admin.ContactManagement.create');
    }


   public function store(Request $request)
{
    $request->validate([
        'primary_email' => 'required|email',
        'alternative_email' => 'nullable|email',
        'primary_number' => 'required',
        'alternative_number' => 'nullable',
        'address' => 'nullable|string',
        'map' => 'nullable|string',
        'linkedin' => 'nullable|url',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'twitter' => 'nullable|url',
    ]);

    Contact::create([
        'primary_email' => $request->primary_email,
        'alternative_email' => $request->alternative_email,
        'primary_number' => $request->primary_number,
        'alternative_number' => $request->alternative_number,
        'address' => $request->address,
        'map' => $request->map,
        'linkedin' => $request->linkedin,
        'facebook' => $request->facebook,
        'instagram' => $request->instagram,
        'twitter' => $request->twitter,
    ]);

    return redirect('admin/contact-management')->with('success', 'Contact details saved successfully.');
}


    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.ContactManagement.edit', compact('contact'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'primary_email' => 'required|email',
        'alternative_email' => 'nullable|email',
        'primary_number' => 'required',
        'alternative_number' => 'nullable',
        'address' => 'nullable|string',
        'map' => 'nullable|string',
        'linkedin' => 'nullable|url',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'twitter' => 'nullable|url',
    ]);

    $contact = Contact::findOrFail($id);
    $contact->update($request->only([
        'primary_email',
        'alternative_email',
        'primary_number',
        'alternative_number',
        'address',
        'map',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
    ]));

    return redirect('admin/contact-management')->with('success', 'Contact updated successfully.');
}


    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
