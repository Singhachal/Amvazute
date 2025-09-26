<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use Illuminate\Support\Str;

class HomeBannerController extends Controller
{
    // public function banner()
    // {
    //     return view('admin.homeBanner.home-banner');
    // }

    public function banner()
{
    $banners = HomeBanner::latest()->get();

    return view('admin.homeBanner.home-banner', compact('banners'));
}


    public function create()
    {
        return view('admin.homeBanner.create');
    }








    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageName = time() . '_' . Str::random(10) . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = 'admin/uploads/home-banner/';
                $imageFile->move(public_path($imagePath), $imageName);

                HomeBanner::create([
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => $imagePath . $imageName,
                    'link' => null, // Optional: modify if you have a field for this
                    'status' => 1, // or default to 'inactive'
                ]);
            }

            return redirect()->back()->with('success', 'Banners uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No image files were uploaded.');
    }

    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('admin.homeBanner.edit', compact('banner'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $banner = HomeBanner::findOrFail($id);

    $banner->title = $request->title;
    $banner->subtitle = $request->subtitle;

    if ($request->hasFile('image')) {
        // Delete old image
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = 'admin/uploads/home-banner/';
        $image->move(public_path($imagePath), $imageName);

        $banner->image = $imagePath . $imageName;
    }

    $banner->save();
    return redirect()->back()->with('success', 'Banner updated successfully.');
}


public function delete($id)
{
    $banner = HomeBanner::findOrFail($id);

    if ($banner->image && file_exists(public_path($banner->image))) {
        unlink(public_path($banner->image));
    }

    $banner->delete();

    return redirect()->back()->with('success', 'Banner deleted successfully.');
}

public function toggleStatus($id)
{
    $banner = HomeBanner::findOrFail($id);
    $banner->status = !$banner->status; // Flip 0 to 1 or 1 to 0
    $banner->save();

    return redirect()->back()->with('success', 'Banner status updated successfully.');
}




}


