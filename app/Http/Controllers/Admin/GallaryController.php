<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallary;
use Illuminate\Support\Facades\File;

class GallaryController extends Controller
{
    public function GallaryManagement()
    {
        $galleries = Gallary::orderBy('id', 'desc')->get();

        return view('admin.gallary.gallary-management', compact('galleries'));
    }

    public  function create()
    {
        return view('admin.gallary.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Store original file name with timestamp prefix
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move image to public/admin/gallery
            $image->move(public_path('admin/gallery'), $imageName);

            // Save each image to the database
            Gallary::create([
                'title' => $request->title,
                'images' => $imageName,
                'status' => 'inactive',
            ]);
        }
    }

    return redirect('admin/gallary-management')->with('success', 'Gallery Images Store successfully.');
}




public function edit($id)
{
    $gallery = Gallary::findOrFail($id);
    return view('admin.gallary.edit', compact('gallery'));
}

public function update(Request $request, $id)
{
    $gallery = Gallary::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $gallery->title = $request->title;

    if ($request->hasFile('images')) {
        // Delete old image
        $oldPath = public_path('admin/gallery/' . $gallery->images);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Save new image
        $image = $request->file('images');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('admin/gallery'), $imageName);
        $gallery->images = $imageName;
    }

    $gallery->save();

    return redirect('admin/gallary-management')->with('success', 'Gallery updated successfully.');
}


public function delete($id)
{
    $gallery = Gallary::findOrFail($id);

    // Delete image from folder
    $imagePath = public_path('admin/gallery/' . $gallery->images);
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    $gallery->delete();

    return redirect()->back()->with('success', 'Gallery deleted successfully.');
}

public function toggleStatus($id)
{
    $gallery = Gallary::findOrFail($id);

    $gallery->status = $gallery->status === 'active' ? 'inactive' : 'active';
    $gallery->save();

    return redirect()->back()->with('success', 'Status updated successfully.');
}


}
