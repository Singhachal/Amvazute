<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventMap;

class EventMapController extends Controller
{
     public function index()
{
    $events = EventMap::whereNotNull('latitude')
                      ->whereNotNull('longitude')
                      ->get();

    return view('admin.map.index', compact('events'));
}

}
