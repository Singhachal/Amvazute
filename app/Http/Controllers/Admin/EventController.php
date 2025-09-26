<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventController extends Controller
{
    public function event()
    {
        $events = Event::latest()->get();
        return view('admin.event.event-management', compact('events'));
    }

    public  function create()
    {
        return view('admin.event.create');
    }



// public function storeEvent(Request $request)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'label' => 'nullable|string|max:100',
//         'status' => 'required|in:active,inactive',
//         'reported_at' => 'nullable|date',
//         'latitude' => 'nullable|numeric',
//         'longitude' => 'nullable|numeric',
//         'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240',
//     ]);

//     $mediaPath = null;
//     $mediaType = null;

//     if ($request->hasFile('media')) {
//         $file = $request->file('media');
//         $extension = strtolower($file->getClientOriginalExtension());

//         $mediaType = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'video';

//         $fileName = 'media_' . time() . '_' . Str::random(5) . '.' . $extension;
//         $file->move(public_path('admin/uploads/event'), $fileName);

//         $mediaPath = $fileName;
//     }

//     // Convert reported_at from "Y-m-d\TH:i" to "Y-m-d H:i:s"
//     $reportedAt = $request->reported_at
//         ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->reported_at)->format('Y-m-d H:i:s')
//         : null;

//     Event::create([
//         'title'        => $request->title,
//         'description'  => $request->description,
//         'label'        => $request->label,
//         'latitude'     => $request->latitude,
//         'longitude'    => $request->longitude,
//         'media_path'   => $mediaPath,
//         'media_type'   => $mediaType ?? 'image', // default to image
//         'reported_at'  => $reportedAt,
//         'status'       => $request->status,
//     ]);

//     return redirect()->back()->with('success', 'Event created successfully!');
// }




public function storeEvent(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'label' => 'nullable|string|max:100',
        'status' => 'required|in:active,inactive',
        'reported_at' => 'nullable|date',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240',
        'media_gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // each max 5MB
    ]);

    $mediaPath = null;
    $mediaType = null;

    if ($request->hasFile('media')) {
        $file = $request->file('media');
        $extension = strtolower($file->getClientOriginalExtension());

        $mediaType = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'video';

        $fileName = 'media_' . time() . '_' . Str::random(5) . '.' . $extension;
        $file->move(public_path('admin/uploads/event'), $fileName);

        $mediaPath = $fileName;
    }

    $reportedAt = $request->reported_at
        ? Carbon::createFromFormat('Y-m-d\TH:i', $request->reported_at)->format('Y-m-d H:i:s')
        : null;

    // Create main event record
    $event = Event::create([
        'title'        => $request->title,
        'description'  => $request->description,
        'label'        => $request->label,
        'latitude'     => $request->latitude,
        'longitude'    => $request->longitude,
        'media_path'   => $mediaPath,
        'media_type'   => $mediaType,
        'reported_at'  => $reportedAt,
        'status'       => $request->status,
    ]);

    // Save main media to event_media
    if ($mediaPath) {
        EventMedia::create([
            'event_id'   => $event->id,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
        ]);
    }

    // Save multiple image gallery
    if ($request->hasFile('media_gallery')) {
        foreach ($request->file('media_gallery') as $image) {
            $extension = strtolower($image->getClientOriginalExtension());

            $fileName = 'gallery_' . time() . '_' . Str::random(5) . '.' . $extension;
            $image->move(public_path('admin/uploads/event'), $fileName);

            EventMedia::create([
                'event_id'   => $event->id,
                'media_path' => $fileName,
                'media_type' => 'image',
            ]);
        }
    }

    return redirect()->back()->with('success', 'Event created successfully!');
}



public function editevent($id)
{
    $event = Event::findOrFail($id);
    return view('admin.event.edit', compact('event'));
}



public function updateevent(Request $request, $id)
{
    $event = Event::findOrFail($id);

    $request->validate([
        'title'         => 'required|string|max:255',
        'description'   => 'required|string',
        'label'         => 'required|string|max:100',
        'status'        => 'required|in:active,inactive',
        'reported_at'   => 'nullable|date',
        'latitude'      => 'nullable|numeric',
        'longitude'     => 'nullable|numeric',
        'media'         => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240',
        'media_gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    $mediaPath = $event->media_path;
    $mediaType = $event->media_type;

    // Replace main media
    if ($request->hasFile('media')) {
        // Delete old file
        if ($mediaPath && file_exists(public_path('admin/uploads/event/' . $mediaPath))) {
            unlink(public_path('admin/uploads/event/' . $mediaPath));
        }

        $file = $request->file('media');
        $extension = strtolower($file->getClientOriginalExtension());
        $mediaType = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'video';
        $fileName = 'media_' . time() . '_' . Str::random(5) . '.' . $extension;
        $file->move(public_path('admin/uploads/event'), $fileName);
        $mediaPath = $fileName;

        // Update in event_media table
        EventMedia::create([
            'event_id'    => $event->id,
            'media_path'  => $mediaPath,
            'media_type'  => $mediaType,
        ]);
    }

    $reportedAt = $request->reported_at
        ? Carbon::createFromFormat('Y-m-d\TH:i', $request->reported_at)->format('Y-m-d H:i:s')
        : null;

    $event->update([
        'title'        => $request->title,
        'description'  => $request->description,
        'label'        => $request->label,
        'latitude'     => $request->latitude,
        'longitude'    => $request->longitude,
        'media_path'   => $mediaPath,
        'media_type'   => $mediaType,
        'reported_at'  => $reportedAt,
        'status'       => $request->status,
    ]);

    // Add new gallery images
    if ($request->hasFile('media_gallery')) {
        foreach ($request->file('media_gallery') as $image) {
            $extension = strtolower($image->getClientOriginalExtension());
            $fileName = 'gallery_' . time() . '_' . Str::random(5) . '.' . $extension;
            $image->move(public_path('admin/uploads/event'), $fileName);

            EventMedia::create([
                'event_id'   => $event->id,
                'media_path' => $fileName,
                'media_type' => 'image',
            ]);
        }
    }

    return redirect()->back()->with('success', 'Event updated successfully!');
}


public function deleteevent($id)
{
    $event = Event::findOrFail($id);

    // Delete media file from public folder if exists
    if ($event->media_path && file_exists(public_path('admin/uploads/event/' . $event->media_path))) {
        unlink(public_path('admin/uploads/event/' . $event->media_path));
    }

    $event->delete();

    return redirect()->back()->with('success', 'Event deleted successfully.');
}


public function toggleStatus($id)
{
    $event = Event::findOrFail($id);

    $event->status = $event->status === 'active' ? 'inactive' : 'active';
    $event->save();

    return redirect()->back()->with('success', 'Status updated successfully!');
}



}
